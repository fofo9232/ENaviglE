<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('admin')->check()){
            return $next($request);
        }
        else{
            request()->session()->flash('error','You do not have any permission to access this page');
            return redirect()->route('admin.login.form');
            //return back()->with('error','you dont have perrmission');
        }
    }
}
