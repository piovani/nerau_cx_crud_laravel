<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::apiResource('/client', ClientController::class);
