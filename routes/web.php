<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Admin\CurrencyController;





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

require __DIR__ .'/frontend.php';

require __DIR__ .'/admin.php';

require __DIR__ .'/seller.php';

Auth::routes(['register'=>false]);

Route::post('coupon/add',[CartController::class ,'couponAdd'])->name('coupon.add');

// order section
Route::post('cart/order',[CheckoutController::class,'store'])->name('cart.order');
Route::get('order/pdf/{id}',[CheckoutController::class,'pdf'])->name('order.pdf');
//currency 
Route::post('currency_load',[CurrencyController::class,'currencyLoad'])->name('currency.load');