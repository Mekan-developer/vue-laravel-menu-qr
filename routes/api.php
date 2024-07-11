<?php

use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\LanguageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/change-lang', [LanguageController::class, 'changeLang']);

Route::get('/get-locale', [LanguageController::class, 'getLocale']);

Route::get('/welcome-message', [LanguageController::class, 'welcomeMessage']);

Route::get('/languages', [LanguageController::class, 'language']);


Route::post('/category-store', [CategoryController::class, 'store']);

Route::get('/get-categories', [CategoryController::class, 'index']);

Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);