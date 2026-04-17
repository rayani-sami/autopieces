<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Models\Coupon;
use Illuminate\Http\Request;
class CartController extends Controller {
    public function __construct(protected CartService $cartService) {}
    public function index() {
        $cart = $this->cartService->getCart();
        $coupon = session('coupon');
        return view('frontend.cart.index',compact('cart','coupon'));
    }
    public function add(Request $request) {
        $request->validate(['product_id'=>'required|integer|exists:products,id','quantity'=>'integer|min:1|max:100']);
        $item = $this->cartService->addToCart($request->product_id,$request->quantity??1);
        if ($request->ajax()) return response()->json(['success'=>true,'count'=>$this->cartService->getCount(),'message'=>'Produit ajouté au panier']);
        return back()->with('success','Produit ajouté au panier !');
    }
    public function update(int $id, Request $request) {
        $request->validate(['quantity'=>'required|integer|min:0|max:100']);
        $this->cartService->updateItem($id,$request->quantity);
        if ($request->ajax()) return response()->json(['success'=>true,'total'=>$this->cartService->getTotal(),'count'=>$this->cartService->getCount()]);
        return back()->with('success','Panier mis à jour.');
    }
    public function remove(int $id) {
        $this->cartService->removeItem($id);
        return back()->with('success','Article supprimé du panier.');
    }
    public function applyCoupon(Request $request) {
        $request->validate(['coupon_code'=>'required|string']);
        $coupon = Coupon::where('code',strtoupper($request->coupon_code))->first();
        if (!$coupon || !$coupon->isValid()) return back()->with('error','Code promo invalide ou expiré.');
        $subtotal = $this->cartService->getTotal();
        if ($subtotal < $coupon->min_order) return back()->with('error','Montant minimum de commande: '.$coupon->min_order.' TND');
        session(['coupon'=>['code'=>$coupon->code,'discount'=>$coupon->calculateDiscount($subtotal),'type'=>$coupon->type,'value'=>$coupon->value]]);
        return back()->with('success','Code promo appliqué !');
    }
    public function removeCoupon() { session()->forget('coupon'); return back()->with('success','Code promo supprimé.'); }
    public function count() { return response()->json(['count'=>$this->cartService->getCount()]); }
}
