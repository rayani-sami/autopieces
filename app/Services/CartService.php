<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    private ?Cart $cartCache = null;

    public function getCart(): Cart
    {
        if ($this->cartCache) {
            return $this->cartCache->load('items.product.images');
        }

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // Merge session cart on login
            $sessionId   = Session::getId();
            $sessionCart = Cart::where('session_id', $sessionId)
                               ->whereNull('user_id')->first();
            if ($sessionCart) {
                foreach ($sessionCart->items as $item) {
                    $existing = $cart->items()->where('product_id', $item->product_id)->first();
                    if ($existing) {
                        $existing->update(['quantity' => min($existing->quantity + $item->quantity, $item->product->stock ?? 999)]);
                    } else {
                        $cart->items()->create([
                            'product_id' => $item->product_id,
                            'quantity'   => $item->quantity,
                            'price'      => $item->price,
                        ]);
                    }
                }
                $sessionCart->delete();
            }
        } else {
            $cart = Cart::firstOrCreate([
                'session_id' => Session::getId(),
                'user_id'    => null,
            ]);
        }

        $this->cartCache = $cart;
        return $cart->load('items.product.images');
    }

    public function addToCart(int $productId, int $quantity = 1): CartItem
    {
        $this->cartCache = null;
        $cart    = $this->getCart();
        $product = Product::findOrFail($productId);

        $item = $cart->items()->where('product_id', $productId)->first();
        if ($item) {
            $newQty = min($item->quantity + $quantity, $product->stock ?: 999);
            $item->update(['quantity' => $newQty]);
        } else {
            $item = $cart->items()->create([
                'product_id' => $productId,
                'quantity'   => min($quantity, $product->stock ?: 999),
                'price'      => $product->price,
            ]);
        }
        $this->cartCache = null;
        return $item->load('product');
    }

    public function updateItem(int $itemId, int $quantity): void
    {
        $cart = $this->getCart();
        $item = $cart->items()->findOrFail($itemId);
        if ($quantity <= 0) {
            $item->delete();
        } else {
            $item->update(['quantity' => min($quantity, $item->product->stock ?: 999)]);
        }
        $this->cartCache = null;
    }

    public function removeItem(int $itemId): void
    {
        $this->getCart()->items()->findOrFail($itemId)->delete();
        $this->cartCache = null;
    }

    public function clearCart(): void
    {
        $this->getCart()->items()->delete();
        $this->cartCache = null;
    }

    public function getTotal(): float
    {
        return (float) $this->getCart()->items->sum(fn($i) => $i->price * $i->quantity);
    }

    public function getCount(): int
    {
        return $this->getCart()->items->sum('quantity');
    }
}
