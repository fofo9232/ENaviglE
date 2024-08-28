<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\SellerLoginController;
use App\Http\Controllers\Seller\SellerController;




Route::prefix('seller')->group(function () {
    Route::get('/login', [SellerLoginController::class,'LoginForm'])->name('seller.login.form');
    Route::post('/login', [SellerLoginController::class,'Login'])->name('seller.login');
});

Route::middleware(['seller'])->prefix('seller')->group(function () {
   

    Route::get('/', [SellerController::class,'seller'])->name('seller');

    //product section

    Route::resource('/seller_product','App\Http\Controllers\seller\ProductController');

});