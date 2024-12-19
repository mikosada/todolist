<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('welcome');
});
Route::get('/signup', function () {
    return view('welcome');
});
// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '.*');

