<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{
    public function getLocale()
    {
        $lang = app()->currentLocale();
        return response()->json(['lang' => $lang]);
    }

    public function language()
    {
        return response()->json([
            'languages' => Config::get('languages')
        ]);
    }

    public function changeLang(Request $request)
    {
        $lang = $request->lang;
        app()->setLocale($lang);
        return response()->json(['success' => "lang is changed - " . app()->getLocale()]);
    }

    public function welcomeMessage(Request $request)
    {
        $lang = request()->lang;
        app()->setLocale($lang);
        // App::setLocale($lang);
        return response()->json(['message' => trans('messages.welcome')]);
    }
}
