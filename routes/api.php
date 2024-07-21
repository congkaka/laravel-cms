<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    //Danh mục
    Route::resource('categories', \App\Http\Controllers\Api\CategoryController::class);
    //Sản phẩm
    Route::resource('products', \App\Http\Controllers\Api\ProductController::class);
    //Loại
    Route::resource('product_variants', \App\Http\Controllers\Api\ProductVariantController::class);
    //Đơn hàng
    Route::post('orders', [\App\Http\Controllers\Api\ApiOrderController::class, 'create']);
    Route::get('orders', [\App\Http\Controllers\Api\ApiOrderController::class, 'filter']);
});
