<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;


class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function currencyLoad(Request $request){
        session()->put('currency_code',$request->currency_code);

        $currency=Currency::where('code',$request->currency_code)->first();

        session()->put('currency_symbol',$currency->symbol);

        session()->put('currency_exchange_rate',$currency->exchange_rate);

        $response['status']=true;

        return $response;

    }
   
        public function index()
    {
        $currency=Currency::orderBy('id','DESC')->paginate(10);
        return view('backend.currency.index')->with('currencies',$currency);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required',
            'symbol'=>'string|required',
            'status'=>'required|in:active,inactive',
            'exchange_rate'=>'numeric|required',
            'code'=>'string|required',
        ]);
        $data= $request->all();
        $status=Currency::create($data);
        if($status){
            request()->session()->flash('success','Currency successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('currency.index');
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
        $currency=Currency::findOrFail($id);
        return view('backend.currency.edit')->with('currency',$currency);
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
        $currency=Currency::find($id);
        if($currency){
        $this->validate($request,[
            'name'=>'string|required',
            'symbol'=>'string|required',
            'status'=>'required|in:active,inactive',
            'exchange_rate'=>'numeric|required',
            'code'=>'string|required',
        ]);
        $data=$request->all();

        $status=$currency->fill($data)->save();
        if($status){
            return redirect()->route('currency.index')->with(['success' => 'updated scussefuly']);
        }
        else{
            return redirect()->route('currency.index')->with(['error' => 'there was something wrong']);
        }

    }else{
        return back()->with('error','Data not Found');
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
        $currency = Currency::find($id);
        if (!currency) {
            return redirect()->route('currency.index', $id)->with(['error' => 'Dtat not found']);
        }
        $currency->delete();

        return redirect()->route('currency.index')->with(['success' => 'updated scussfuly']);
    }
}
