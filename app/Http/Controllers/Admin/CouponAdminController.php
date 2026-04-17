<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
class CouponAdminController extends Controller {
    public function index() { $coupons = Coupon::latest()->paginate(25); return view('admin.settings.coupons',compact('coupons')); }
    public function create() { return view('admin.settings.coupon_create'); }
    public function store(Request $request) {
        $request->validate(['code'=>'required|string|max:50|unique:coupons','type'=>'required|in:percentage,fixed','value'=>'required|numeric|min:0','min_order'=>'nullable|numeric|min:0','usage_limit'=>'nullable|integer|min:1','expires_at'=>'nullable|date']);
        Coupon::create($request->all()+['is_active'=>$request->boolean('is_active',true)]);
        return redirect()->route('admin.coupons.index')->with('success','Coupon créé.');
    }
    public function edit(Coupon $coupon) { return view('admin.settings.coupon_edit',compact('coupon')); }
    public function update(Request $request, Coupon $coupon) {
        $coupon->update($request->all()+['is_active'=>$request->boolean('is_active')]);
        return back()->with('success','Coupon mis à jour.');
    }
    public function destroy(Coupon $coupon) { $coupon->delete(); return back()->with('success','Coupon supprimé.'); }
}
