<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function wishlist(){
        return view('frontend.pages.wishlist');
    }
    public function addWishlist(Request $request, $slug){
      // dd($request->all());
      if (empty($request->slug)) {
        request()->session()->flash('error','Invalid Products');
        return back();
    }        
    $product = Product::where('slug', $request->slug)->first();
    // return $product;
    if (empty($product)) {
        request()->session()->flash('error','Invalid Products');
        return back();
    }

    $already_wishlist = Wishlist::where('user_id', auth()->user()->id)->where('cart_id',null)->where('product_id', $product->id)->first();
    // return $already_wishlist;
    if($already_wishlist) {
        request()->session()->flash('error','You already placed in wishlist');
        return back();
    }else{
        
        $wishlist = new Wishlist;
        $wishlist->user_id = auth()->user()->id;
        $wishlist->product_id = $product->id;
        $wishlist->price = ($product->price-($product->price*$product->discount)/100);
        $wishlist->quantity = 1;
        $wishlist->amount=$wishlist->price*$wishlist->quantity;
        if ($wishlist->product->stock < $wishlist->quantity || $wishlist->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
        $wishlist->save();
    }
    request()->session()->flash('success','Product successfully added to wishlist');
    return back();        

    }
    public function wishlistDelete($id){
        $wishlist = Wishlist::find($id);
        if ($wishlist) {
            $wishlist->delete();
            request()->session()->flash('success','Wishlist successfully removed');
            return back();  
        }
        request()->session()->flash('error','Error please try again');
        return back();       
    }     
}
