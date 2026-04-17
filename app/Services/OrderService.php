<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusHistory;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderService
{
    public function __construct(protected CartService $cartService) {}

    public function placeOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $cart = $this->cartService->getCart();

            if ($cart->items->isEmpty()) {
                throw new \Exception('Votre panier est vide.');
            }

            $subtotal     = $this->cartService->getTotal();
            $shippingCost = $this->calculateShipping($subtotal, $data['city'] ?? '');
            $discount     = 0;
            $coupon       = null;

            // Apply coupon
            if (!empty($data['coupon_code'])) {
                $coupon = Coupon::where('code', strtoupper($data['coupon_code']))->first();
                if ($coupon && $coupon->isValid()) {
                    $discount = $coupon->calculateDiscount($subtotal);
                }
            }

            // Create order
            $order = Order::create([
                'order_number'        => Order::generateOrderNumber(),
                'user_id'             => Auth::id(),
                'status'              => 'pending',
                'payment_method'      => $data['payment_method'] ?? 'cash_on_delivery',
                'payment_status'      => 'pending',
                'shipping_first_name' => $data['first_name'],
                'shipping_last_name'  => $data['last_name'],
                'shipping_phone'      => $data['phone'],
                'shipping_address'    => $data['address'],
                'shipping_city'       => $data['city'],
                'shipping_state'      => $data['state'] ?? null,
                'shipping_country'    => 'TN',
                'subtotal'            => $subtotal,
                'shipping_cost'       => $shippingCost,
                'discount'            => $discount,
                'total'               => round($subtotal + $shippingCost - $discount, 3),
                'coupon_code'         => $coupon?->code,
                'notes'               => $data['notes'] ?? null,
            ]);

            // Create order items & decrement stock
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id'          => $order->id,
                    'product_id'        => $item->product_id,
                    'product_name'      => $item->product->name,
                    'product_reference' => $item->product->reference,
                    'quantity'          => $item->quantity,
                    'unit_price'        => $item->price,
                    'total_price'       => round($item->price * $item->quantity, 3),
                ]);
                // Safely decrement stock
                if ($item->product->stock > 0) {
                    $item->product->decrement('stock', min($item->quantity, $item->product->stock));
                }
            }

            // Update coupon usage
            if ($coupon) {
                $coupon->increment('used_count');
            }

            // Status history
            OrderStatusHistory::create([
                'order_id' => $order->id,
                'status'   => 'pending',
                'comment'  => 'Commande passée par le client.',
                'user_id'  => Auth::id(),
            ]);

            // Clear cart
            $this->cartService->clearCart();

            // Send confirmation email (non-blocking)
            $this->sendConfirmationEmail($order->load('items'));

            return $order;
        });
    }

    public function updateStatus(Order $order, string $status, string $comment = '', ?int $userId = null): void
    {
        $order->update(['status' => $status]);
        OrderStatusHistory::create([
            'order_id' => $order->id,
            'status'   => $status,
            'comment'  => $comment,
            'user_id'  => $userId ?? Auth::id(),
        ]);
    }

    public function calculateShipping(float $subtotal, string $city = ''): float
    {
        // Free shipping above threshold
        if ($subtotal >= 200) return 0.0;

        $tunisCities = [
            'tunis', 'ariana', 'ben arous', 'la marsa', 'carthage',
            'la goulette', 'manouba', 'bardo', 'ezzouhour', 'ettadhamen',
            'mnihla', 'raoued', 'soukra', 'el mourouj', 'megrine',
        ];

        $cityLower = mb_strtolower(trim($city));
        foreach ($tunisCities as $tc) {
            if (str_contains($cityLower, $tc)) return 8.0;
        }

        return 12.0;
    }

    protected function sendConfirmationEmail(Order $order): void
    {
        try {
            $userEmail = $order->user?->email;
            if ($userEmail) {
                Mail::send(
                    'emails.order_confirmation',
                    ['order' => $order],
                    function ($m) use ($order, $userEmail) {
                        $m->to($userEmail)
                          ->subject('Confirmation commande #' . $order->order_number . ' - AutoPart');
                    }
                );
            }
            // Also notify admin
            Mail::send(
                'emails.order_notification_admin',
                ['order' => $order],
                function ($m) use ($order) {
                    $m->to(config('mail.from.address', 'autopart.tunisia@gmail.com'))
                      ->subject('[AutoPart] Nouvelle commande #' . $order->order_number);
                }
            );
        } catch (\Exception $e) {
            Log::warning('Email sending failed for order ' . $order->order_number . ': ' . $e->getMessage());
        }
    }
}
