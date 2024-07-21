<?php

use App\Http\Controllers\Web\Owlio\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::match(['get', 'post'], "dang-nhap", [\App\Http\Controllers\Web\Owlio\UserController::class, 'login'])->name('login');
Route::match(['get', 'post'], "dang-ky", [\App\Http\Controllers\Web\Owlio\UserController::class, 'register'])->name('register');

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get("settings/user", [\App\Http\Controllers\Web\Owlio\UserController::class, 'index'])->name('list-user');




    Route::get("lich-su-so-du", [\App\Http\Controllers\Web\Owlio\UserController::class, 'walletHistory'])->name('wallet_history');
    Route::post("set_timezone", [\App\Http\Controllers\Web\Owlio\UserController::class, 'setTimezone'])->name('set_timezone');
    Route::get("thong-tin-tai-khoan", [\App\Http\Controllers\Web\Owlio\UserController::class, 'profile'])->name('profile');
    Route::post("thong-tin-tai-khoan", [\App\Http\Controllers\Web\Owlio\UserController::class, 'updateProfile']);
    Route::match(['get'], "dang-xuat", [\App\Http\Controllers\Web\Owlio\UserController::class, 'logout'])->name('logout');
    Route::post("create-token", [\App\Http\Controllers\Web\Owlio\UserController::class, 'createToken'])->name('create_token');
    Route::get("nap-tien", [\App\Http\Controllers\Web\Owlio\UserController::class, 'deposit'])->name('deposit');
    Route::post("nap-tien", [\App\Http\Controllers\Admin\Deposit\DepositController::class, 'createRequest']);


    Route::get('/mua-dich-vu/{id}', [\App\Http\Controllers\Web\Owlio\OrderController::class, 'checkout'])->name('checkout');
    Route::post('/mua-dich-vu/{id}', [\App\Http\Controllers\Web\Owlio\OrderController::class, 'create'])->name('order');
    Route::get('/lich-su-mua-hang', [\App\Http\Controllers\Web\Owlio\OrderController::class, 'history'])->name('order-history');
});
