<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json(['Message' => 'A Aplicacao so possui rotas API']);
});
