<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


use Session;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function userLogin(){
            return view('frontend.pages.login');

    }
    
    public function userRegister(){
        return view('frontend.pages.register');
    }

    public function loginSubmit(Request $request){
        $this->validate($request,
        [
            
            'email'=>'email|required|exists:users,email',
            'password'=>'required|min:4',
            
        ]);
        if(Auth::attempt(['email'=> $request->email , 'password'=>$request->password, 'status'=>'active'])){
            Session::put('user',$request->email);
            if(Session::get('url.intended')){
                return Redirect::to(Session::get('url.intended'));
            }else{
                return redirect()->route('index')->with('success', 'you  successfully  login');
            }
            
        }else{
            return back()->with('error', 'Invalid email & password');
        }

    }

    public function registerSubmit(Request $request){
        $this->validate($request,
        [
            
            'full_name'=>'string|required|max:30',
            'email'=>'string|required|unique:users,email',
            'password'=>'confirmed|required|min:4',
            
        ]);
        
        $data=$request->all();
        $status=$this->create($data);
        
        if($status){
            return redirect()->route('login.form')->with('success', 'you registred successfully please login');
        }
        else{
           return back();
        }

    }

    private function create(array $data){
        return User::create([
            'full_name'=> $data['full_name'],
            'email'=> $data['email'],
            'password'=>Hash::make ($data['password']),
        ]);
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        return redirect()->route('index')->with('success', 'you  successfully  logout');;
    }
}
