<?php

use Illuminate\Support\Facades\Route;

Route::get('{page}', function () {
    return view('welcome');
})->where('page','.*');

// Route::get('/login', function () {
//     return view('welcome');
// });


// Route::get('/dashboard', function () {
//     return view('welcome');
// });

// Route::get('/dashboard/{page}', function () {
//     return view('welcome');
// })->where('page', '.*');

// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '.*');
