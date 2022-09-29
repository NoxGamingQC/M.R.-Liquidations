<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/store', function () {
    return view('store');
});

Route::get('/privacy_policy', function () {
    return view('privacy_policy');
});

Route::get('/contact_us', function () {
    return view('contact_us');
});
