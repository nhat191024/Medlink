<?php

use Illuminate\Support\Facades\Route;
use League\Csv\Query\Row;
use App\Http\Controllers\LoginController;
Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/login',function(){
    return view('auth.login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
