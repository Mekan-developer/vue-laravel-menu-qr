<?php

use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\FoodController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PayloadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/change-lang', [LanguageController::class, 'changeLang']);

Route::get('/get-locale', [LanguageController::class, 'getLocale']);

Route::get('/welcome-message', [LanguageController::class, 'welcomeMessage']);

Route::get('/languages', [LanguageController::class, 'language']);

Route::get('/get-categories', [CategoryController::class, 'index']);
Route::post('/category-store', [CategoryController::class, 'store']);
Route::get('/edit-category/{category}', [CategoryController::class, 'edit']);
Route::post('/category-store', [CategoryController::class, 'store']);
Route::post('/category-update/{category}', [CategoryController::class, 'update']);

Route::get('/food-create', [FoodController::class, 'create']);
Route::apiResource('foods', FoodController::class);


Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);







Route::get('/generate-payload', [PayloadController::class, 'createPayload']);

