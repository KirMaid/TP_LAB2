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
Route::delete('/catalog/{id}', [Controllers\CatalogController::class,'deleteProduct'])->name('product.delete');
Route::get('/catalog/category/{name}', [Controllers\CatalogController::class,'category'])->name('catalog.category');
Route::get('/catalog/brand/{name}', [Controllers\CatalogController::class,'brand'])->name('catalog.brand');
Route::get('/catalog/product/{name}', [Controllers\CatalogController::class,'product'])->name('catalog.product');

Route::post('/coupon/apply', [Controllers\CouponController::class,'apply'])->name('coupon.apply');
Route::delete('/coupon/remove', [Controllers\CouponController::class,'remove'])->name('coupon.remove');

# Добавление продуктов
Route::get('/add-product', [Controllers\ProductController::class,'create'])->name('product.create');
Route::post('/add-product', [Controllers\ProductController::class,'store'])->name('product.store');
Route::get('/add-product/generate-description', [Controllers\ProductController::class,'generateDesc'])->name('product.desc');

# Обновление продукта
Route::get('/update-product/{id}', [Controllers\ProductController::class,'update'])->name('product.update.index');
Route::post('/update-product/{id}', [Controllers\ProductController::class,'updateProduct'])->name('product.update');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
