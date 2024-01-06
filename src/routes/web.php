<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controllers\MainController::class,'index'])->name('index');

Auth::routes();

#TODO: Поправить и убрать
#Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/catalog/', [Controllers\CatalogController::class,'index'])->name('catalog.index');
Route::get('/catalog/category/{slug}', [Controllers\CatalogController::class,'category'])->name('catalog.category');
Route::get('/catalog/brand/{slug}', [Controllers\CatalogController::class,'brand'])->name('catalog.brand');
Route::get('/catalog/product/{slug}', [Controllers\CatalogController::class,'product'])->name('catalog.product');

Route::post('/coupon/apply', [Controllers\CouponController::class,'apply'])->name('coupon.apply');
Route::delete('/coupon/remove', [Controllers\CouponController::class,'remove'])->name('coupon.remove');
