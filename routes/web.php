<?php

use Illuminate\Support\Facades\Route;

Route::get('/database-erd', function () {
    return view('database.erd');
});

Route::get('/', function () {
    return view('welcome');
});
