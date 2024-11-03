<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});
Route::get('/home', function () {
    return view('dashboard');
});
