<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
class CheckoutController extends Controller {
    public function __construct(protected CartService $cartService, protected OrderService $orderService) {}
    public function index() {
        $cart = $this->cartService->getCart();
        if ($cart->items->isEmpty()) return redirect()->route('cart.index')->with('error','Votre panier est vide.');
        $coupon = session('coupon');
        $subtotal = $this->cartService->getTotal();
        $discount = $coupon['discount']??0;
        $shippingCost = $this->orderService->calculateShipping($subtotal-$discount, auth()->user()->defaultAddress?->city??'');
        $user = auth()->user()->load(['addresses','defaultAddress']);
        return view('frontend.checkout.index',compact('cart','coupon','subtotal','discount','shippingCost','user'));
    }
    public function place(Request $request) {
        $request->validate(['first_name'=>'required|string|max:100','last_name'=>'required|string|max:100','phone'=>'required|string|max:20','address'=>'required|string|max:255','city'=>'required|string|max:100','payment_method'=>'required|in:cash_on_delivery,bank_transfer','notes'=>'nullable|string|max:500']);
        try {
            $data = $request->all();
            if ($coupon = session('coupon')) $data['coupon_code'] = $coupon['code'];
            $order = $this->orderService->placeOrder($data);
            session()->forget('coupon');
            return redirect()->route('checkout.confirmation',$order)->with('success','Commande passée avec succès !');
        } catch(\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
    }
    public function confirmation(Order $order) {
        if ($order->user_id !== auth()->id()) abort(403);
        return view('frontend.checkout.confirmation',compact('order'));
    }
}
