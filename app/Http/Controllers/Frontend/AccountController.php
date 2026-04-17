<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\UserVehicle;
use App\Models\Engine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AccountController extends Controller {
    public function index() { return view('frontend.account.index',['user'=>auth()->user()->load('orders')]); }
    public function orders() { $orders=auth()->user()->orders()->paginate(10); return view('frontend.account.orders',compact('orders')); }
    public function orderDetail(Order $order) {
        if ($order->user_id!==auth()->id()) abort(403);
        return view('frontend.account.order_detail',['order'=>$order->load('items.product','statusHistory')]);
    }
    public function profile() { return view('frontend.account.profile',['user'=>auth()->user()]); }
    public function updateProfile(Request $request) {
        $request->validate(['first_name'=>'required|string|max:100','last_name'=>'required|string|max:100','phone'=>'nullable|string|max:20','email'=>'required|email|unique:users,email,'.auth()->id()]);
        auth()->user()->update($request->only('first_name','last_name','phone','email'));
        return back()->with('success','Profil mis à jour.');
    }
    public function updatePassword(Request $request) {
        $request->validate(['current_password'=>'required','password'=>'required|min:8|confirmed']);
        if (!Hash::check($request->current_password,auth()->user()->password)) return back()->with('error','Mot de passe actuel incorrect.');
        auth()->user()->update(['password'=>Hash::make($request->password)]);
        return back()->with('success','Mot de passe modifié.');
    }
    public function addresses() { return view('frontend.account.addresses',['addresses'=>auth()->user()->addresses]); }
    public function storeAddress(Request $request) {
        $request->validate(['label'=>'required|string|max:50','first_name'=>'required|string|max:100','last_name'=>'required|string|max:100','phone'=>'required|string|max:20','address_line1'=>'required|string|max:255','city'=>'required|string|max:100']);
        if ($request->is_default) auth()->user()->addresses()->update(['is_default'=>false]);
        auth()->user()->addresses()->create($request->all());
        return back()->with('success','Adresse ajoutée.');
    }
    public function updateAddress(Address $address, Request $request) {
        if ($address->user_id!==auth()->id()) abort(403);
        if ($request->is_default) auth()->user()->addresses()->update(['is_default'=>false]);
        $address->update($request->all());
        return back()->with('success','Adresse mise à jour.');
    }
    public function deleteAddress(Address $address) {
        if ($address->user_id!==auth()->id()) abort(403);
        $address->delete();
        return back()->with('success','Adresse supprimée.');
    }
    public function vehicles() { return view('frontend.account.vehicles',['vehicles'=>auth()->user()->vehicles()->with('engine.carModel.make')->get()]); }
    public function storeVehicle(Request $request) {
        $request->validate(['engine_id'=>'required|exists:engines,id','label'=>'nullable|string|max:100','plate'=>'nullable|string|max:20']);
        auth()->user()->vehicles()->create($request->only('engine_id','label','plate'));
        return back()->with('success','Véhicule ajouté.');
    }
    public function deleteVehicle(UserVehicle $vehicle) {
        if ($vehicle->user_id!==auth()->id()) abort(403);
        $vehicle->delete();
        return back()->with('success','Véhicule supprimé.');
    }
}
