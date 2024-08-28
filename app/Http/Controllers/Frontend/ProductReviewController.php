<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;

class ProductReviewController extends Controller
{
    public function productReview(Request $request){
        $this->validate($request,[
            'rate'=>'required|numeric',
            'review'=>'nullable|string',
        ]);

        $data=$request->all();
        $status=ProductReview::create($data);
        if($status){
            return back()->with('success','Thanks for your feedback');
        }
        else{
            return back()->with('error','Please try again!');
        }




    }
}
