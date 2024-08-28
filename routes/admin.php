<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SellerController;





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

//frontend section//




//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// admin login
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class,'adminLoginForm'])->name('admin.login.form');
    Route::post('/login', [AdminLoginController::class,'adminLogin'])->name('admin.login');
});
 //admin dashbord//
Route::middleware(['admin'])->prefix('admin')->group(function () {
   

    Route::get('/', [AdminController::class,'admin'])->name('admin');

 //banner section
 
 Route::get('banner',[App\Http\Controllers\Admin\BannerController::class, 'index'])->name('banner.index');
 Route::get('create',[BannerController::class, 'create'])->name('banner.create');
 Route::post('store',[BannerController::class, 'store'])->name('banner.store');
 Route::get('edit/{id}',[BannerController::class, 'edit'])->name('banner.edit');
 Route::post('update/{id}',[BannerController::class, 'update'])->name('banner.update');
 Route::get('destroy/{id}',[BannerController::class, 'destroy'])->name('banner.destroy');

 //category section

 Route::resource('/category','App\Http\Controllers\Admin\CategoryController');

 //currancy section

 Route::resource('/currency','App\Http\Controllers\Admin\CurrencyController');

//Settings

 Route::get('settings',[SettingsController::class,'settings'])->name('settings');
 Route::post('settings',[SettingsController::class,'update'])->name('settings.update');


 //brand section

 Route::resource('/brand','App\Http\Controllers\Admin\BrandController');

//product section

Route::resource('/product','App\Http\Controllers\Admin\ProductController');

//user section

Route::resource('/users','App\Http\Controllers\Admin\UserController');

//order section

Route::resource('/order','App\Http\Controllers\Admin\OrderController');

//coupon section

Route::resource('/coupon','App\Http\Controllers\Admin\CouponController');

//shipping section

Route::resource('/shipping','App\Http\Controllers\Admin\ShippingController');

//seller section

Route::resource('/seller','App\Http\Controllers\Admin\SellerController');
Route::post('seller-status',[SellerController::class,'sellerStatus'])->name('seller.status');
Route::post('seller-verified',[SellerController::class,'sellerVerified'])->name('seller.verified');


});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

