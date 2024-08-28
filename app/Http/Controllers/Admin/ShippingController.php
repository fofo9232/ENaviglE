<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings= Shipping::orderBy('id','DESC')->get();
        return view('backend.shipping.index')->with('shippings', $shippings);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shipping.create');
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
           'type'=>'required',
           'price'=>'numeric'
       ]);
       $data=$request->all();
       $status= Shipping::create($data);
       if($status){
           return redirect()->route('shipping.index')->with('success', 'shipping created successfully');
       }else{
           return back()->with('error', 'something went wrong');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping= Shipping::find($id);
        return view('backend.shipping.edit')->with('shipping',$shipping);
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
        $shipping= Shipping::find($id);
        if($shipping){
            $this->validate($request,[
                'type'=>'required',
                'price'=>'numeric'
            ]);
            $data=$request->all();
            $status= $shipping->fill($data)->save();
            if($status){
                return redirect()->route('shipping.index')->with('success', 'shipping created successfully');
            }else{
                return back()->with('error', 'something went wrong');
            }
        }else{
            return back()->with('error', 'shipping not found');
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
        $shipping= Shipping::find($id);
        if($shipping){
            $status= $shipping->delete();
            if($status){
                return redirect()->route('shipping.index')->with('success','shipping deleted successfully');
            }else{
                return back()->with('error', 'something wrong !!');
            }
        }
    
    else{
        return back()->with('error', 'shipping not found');
    }
    }
}
