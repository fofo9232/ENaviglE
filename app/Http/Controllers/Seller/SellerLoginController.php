<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SellerLoginController extends Controller
{
    public function LoginForm(){

        return view('auth.seller.login');

    }
    public function Login(Request $request){
        if(Auth::guard('seller')->attempt(['email'=>$request->email,'password'=>$request->password ])){
            return redirect()->intended(route('seller'))->with('success','you  are logged as seller');
        }
        return back()->withInput($request->only('email'));
    }
}
