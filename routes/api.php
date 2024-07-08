<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/change-lang', function (Request $request) {
    $lang = $request->lang;
    app()->setLocale($lang);
    return response()->json(['success' => "lang is changed - " . app()->getLocale()]);
});

Route::get('/get-locale', [LanguageController::class, 'getLocale']);

Route::get('/welcome-message', function (Request $request) {
    $lang = request()->lang;
    app()->setLocale($lang);
    // App::setLocale($lang);
    return response()->json(['message' => trans('messages.welcome')]);
});