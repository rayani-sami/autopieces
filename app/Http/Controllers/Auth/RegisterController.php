<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller {
    public function showRegistrationForm() { return view('frontend.auth.register'); }
    public function register(Request $request) {
        $request->validate(['first_name'=>'required|string|max:100','last_name'=>'required|string|max:100','email'=>'required|email|unique:users','phone'=>'nullable|string|max:20','password'=>'required|min:8|confirmed']);
        $user = User::create(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'phone'=>$request->phone,'password'=>Hash::make($request->password)]);
        $user->assignRole('client');
        Auth::login($user);
        return redirect()->route('account.index')->with('success','Bienvenue '.$user->first_name.' !');
    }
}
