<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ProductReviewController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register'=>false]);
//frontend section//
Route::get('/', [IndexController::class , 'home'])->name('index');
//end of frontend section//

//about us section
Route::get('/about-us', [IndexController::class , 'aboutUs'])->name('about.us');

//contact section
Route::get('/contact', [IndexController::class , 'contact'])->name('contact');
Route::post('/contact/message' ,[IndexController::class ,'contactStore'])->name('contact.store');


//user section//
Route::get('user/login', [UserController::class , 'userLogin'])->name('login.form');
Route::get('user/register', [UserController::class , 'userRegister'])->name('register.form');
Route::post('user/login', [UserController::class , 'loginSubmit'])->name('login.submit');
Route::post('user/register', [UserController::class , 'registerSubmit'])->name('register.submit');
Route::get('user/logout', [UserController::class , 'logout'])->name('user.logout');
Route::get('user/indexx', [IndexController::class , 'userIndex'])->name('user.index');

//end of user//
//product category//
Route::get('product-cat/{slug}', [IndexController::class , 'productCategory'])->name('product.category');
//end product category//

//product details//
Route::get('product-detail/{slug}', [IndexController::class , 'productDetail'])->name('product.details');
//end product details//

//Product Review
Route::post('product-review/{slug}',[ProductReviewController::class,'productReview'])->name('product.review');


// Cart section
Route::get('/add-to-cart/{slug}',[CartController::class ,'addToCart'])->name('add-to-cart')->middleware('user');
Route::post('/add-to-cart',[CartController::class ,'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
Route::get('cart-delete/{id}',[CartController::class ,'cartDelete'])->name('cart-delete');
Route::post('cart-update',[CartController::class ,'cartUpdate'])->name('cart.update');
Route::get('/cart',[CartController::class ,'getCart'])->name('cart');
Route::get('/checkout',[CartController::class ,'checkout'])->name('checkout')->middleware('user');


// wishlist section
Route::get('wishlist', [WishlistController::class , 'wishlist'])->name('wishlist');
Route::get('/wishlist/{slug}',[WishlistController::class , 'addWishlist'])->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/{id}',[WishlistController::class , 'wishlistDelete'])->name('wishlist-delete');

// checkout section

Route::get('checkout', [CheckoutController::class , 'checkout'])->name('checkout');



