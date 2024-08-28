<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function adminLoginForm(){

        return view('auth.admin.login');
    }
    public function adminLogin(Request $request){
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password ])){
            return redirect()->intended(route('admin'))->with('success','you  are logged as admin');
        }
        return back()->withInput($request->only('email'));
    }
}
