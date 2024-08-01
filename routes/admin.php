<?php

use Illuminate\Support\Facades\Route;

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

Route::get('login', function () {
    return view('admin.auth.login');
})->name('admin.login');

Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login']);

Route::group(['middleware' => ['web', 'auth', 'admin']], function () {
    Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

    Route::get('', function () {
        return view('admin.dashboard');
    });
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    // Router Category
    Route::group([], function () {
        Route::resource('categories', \App\Http\Controllers\Admin\Category\CategoryController::class, ["as"=>"admin"]);
    });
    // Router Product
    Route::group([], function () {
        Route::resource('product', \App\Http\Controllers\Admin\Product\ProductController::class, ["as"=>"admin"]);
        Route::put('product/{id}/change_active', [\App\Http\Controllers\Admin\Product\ProductController::class, 'changeActive'])->name('admin.product.change_active');
    });
    // Router ProductVariant
    Route::group([], function () {
        Route::resource('product_variant', \App\Http\Controllers\Admin\ProductVariant\ProductVariantController::class, ["as"=>"admin"]);
        Route::put('product_variant/{id}/change_active', [\App\Http\Controllers\Admin\ProductVariant\ProductVariantController::class, 'changeActive'])->name('admin.product_variant.change_active');
    });
    // Router User
    Route::group([], function () {
        Route::resource('user', \App\Http\Controllers\Admin\User\UserController::class, array("as"=>"admin"));
        Route::get('user-wallet-history', [\App\Http\Controllers\Admin\User\UserController::class, 'walletHistory'])->name('admin.user.wallet_history');
        Route::get('decentralization', [\App\Http\Controllers\Admin\User\UserController::class, 'decentralization'])->name('admin.user.decentralization');
        Route::post('decentralization', [\App\Http\Controllers\Admin\User\UserController::class, 'decentralization'])->name('admin.user.update.permissions');
    });

    // Router Blogs
    Route::group([], function () {
        Route::resource('blogs', \App\Http\Controllers\Admin\Blog\BlogController::class, array("as"=>"admin"));
    });

    // Router Order
    Route::group([], function () {
        Route::resource('order', \App\Http\Controllers\Admin\Order\OrderController::class, array("as"=>"admin"));
        Route::get('order/{id}/change_state', [\App\Http\Controllers\Admin\Order\OrderController::class, 'changeState'])->name('admin.order.change_state');
    });
    // Router Setting
    Route::group(['prefix' => 'setting'], function () {
        Route::match('get', 'contact', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'contact'])->name('admin.setting.contact');
        Route::match('get', 'telegram', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'telegram'])->name('admin.setting.telegram');
        Route::match('get', 'image', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'image'])->name('admin.setting.image');
        Route::match('get', 'footer', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'footer'])->name('admin.setting.footer');
        Route::match('get', 'menu', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'menu'])->name('admin.setting.menu');
        Route::match('post', 'update', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'updateSiteSetting'])->name('admin.setting.update');
        Route::match(['get'], 'bank', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'bank'])->name('admin.setting.pay');
    });
    // Router Deposit
    Route::group([], function () {
        Route::resource('deposit', \App\Http\Controllers\Admin\Deposit\DepositController::class, array("as"=>"admin"));
        Route::match(['get'], '/{id}/changestatus', [\App\Http\Controllers\Admin\Deposit\DepositController::class, 'changeStatus'])->name('admin.deposit.status');
    });
    // Router BalanceHistory
    Route::group([], function () {
        Route::resource('balance_history', \App\Http\Controllers\Admin\BalanceHistory\BalanceHistoryController::class, array("as"=>"admin"));
    });
});
