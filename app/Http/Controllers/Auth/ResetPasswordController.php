<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
class ResetPasswordController extends Controller {
    use ResetsPasswords;
    protected $redirectTo = '/compte';
    public function showResetForm(\Illuminate\Http\Request $request, $token=null) { return view('frontend.auth.reset_password',compact('token')); }
}
