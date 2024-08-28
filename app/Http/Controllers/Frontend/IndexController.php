<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\Message;


use App\User;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        $category=Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
        $new_products=Product::where('status' ,'active')->where( 'condition','new')->orderBy('id', 'DESC')->limit('8')->get();
        $orders=Order::orderBy('id','DESC')->get();
        $hot_products=Product::where('status' ,'active')->where( 'condition','hot')->orderBy('id', 'DESC')->limit('10')->get();

        
        return view('frontend.index')

                ->with('banners',$banners)
                ->with('category',$category)
                ->with('new_products',$new_products)
                ->with('orders',$orders)
                ->with('hot_products',$hot_products);


    }

    public function productCategory($slug){

        $categories= Category::with('products')->where('slug',$slug)->first();
        return view('frontend.pages.product-lists')->with('categories',$categories);
    }

    public function productDetail($slug){

        $products= Product::with('rel_prods')->where('slug',$slug)->first();
        $reviews = ProductReview::get();
        if($products){
            return view('frontend.pages.product-details')->with('products', $products)
                                                        ->with('reviews' , $reviews); 
        }else
        {

            return view('errors.404');
        }
       
    }
    public function userIndex(){
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        $category=Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
        $new_products=Product::where('status' ,'active')->where( 'condition','new')->orderBy('id', 'DESC')->limit('8')->get();
        
        return view('user.index')

                ->with('banners',$banners)
                ->with('category',$category)
                ->with('new_products',$new_products);

    }
    public function aboutUs(){
        return view('frontend.pages.about-us');
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function contactStore(Request $request){
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'email|required',
            'message'=>'required|min:20|max:200',
            'subject'=>'string|required',
            'phone'=>'numeric|required'
        ]);

        $data= $request->all();
        $status=Message::create($data);
        if($status){
            request()->session()->flash('success','Thank you your message has been sent');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('contact');
    }

    
}
