<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function getLocale()
    {
        $lang = app()->currentLocale();
        return response()->json(['lang' => $lang]);
    }
}
