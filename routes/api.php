<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/change-lang', function (Request $request) {
    $lang = $request->query('lang', 'en');
    app()->setLang($lang);
    return response()->json(['message' => trans('messages.welcome')]);
});

Route::get('/welcome-message', function () {
    return response()->json(['message' => trans('messages.welcome')]);
});
Route::get('/get-locale', [LanguageController::class, 'getLocale']);