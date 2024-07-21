<?php

use Illuminate\Support\Facades\Route;

Route::any("upload", [\App\Http\Controllers\UploadController::class, 'storeMultipleFile'])->name('storage.upload');
Route::any("ck_upload", [\App\Http\Controllers\UploadController::class, 'ckeditorUpload'])->name('storage.ck_upload');
