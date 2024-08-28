<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons= Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.index')->with('coupons',$coupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'code'=>'required|min:2',
            'type'=>'required|in:fixed,precent',
            'value'=>'required|numeric',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        $status=Coupon::create($data);
        if($status){
            return redirect()->route('coupon.index')->with('success','coupon added successfully');
        }else{
            return back()->with('error', 'something wrong !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        if($coupon){
            return view('backend.coupon.edit')->with('coupon',$coupon);
        }else{
            return back()->with('error', 'coupon not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        if($coupon){
            $this->validate($request,[
                'code'=>'required|min:2',
                'type'=>'required|in:fixed,precent',
                'value'=>'required|numeric',
                'status'=>'required|in:active,inactive'
            ]);
            $data=$request->all();
        $status=$coupon->fill($data)->save();
        if($status){
            return redirect()->route('coupon.index')->with('success','coupon updated successfully');
        }else{
            return back()->with('error', 'something wrong !!');
        }
    }
    else{
        return back()->with('error', 'coupon not found');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if($coupon){
            $status= $coupon->delete();
            if($status){
                return redirect()->route('coupon.index')->with('success','coupon deleted successfully');
            }else{
                return back()->with('error', 'something wrong !!');
            }
        }
    
    else{
        return back()->with('error', 'coupon not found');
    }
}
}
