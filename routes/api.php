<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::apiResource('/client', ClientController::class);
Route::apiResource('/product', ProductController::class);
Route::apiResource('/order', OrderController::class);
