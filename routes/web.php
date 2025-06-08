<?php

use Illuminate\Support\Facades\Route;
use League\Csv\Query\Row;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/login',function(){
    return view('auth.login');
});
