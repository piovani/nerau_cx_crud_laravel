<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

Route::get('auth/login', AuthController::class . '@login');

Route::middleware(['jwt'])->group(function () {
    Route::get('auth/logout', AuthController::class . '@logout');

    Route::apiResource('/client', ClientController::class);
    Route::apiResource('/product', ProductController::class);
    Route::apiResource('/order', OrderController::class);
});

