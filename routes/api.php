<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;

Route::apiResource('/client', ClientController::class);
Route::apiResource('/product', ProductController::class);
