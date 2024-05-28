<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        Log::info('LanguageController: Switching language to ' . $lang); // Log

        if (array_key_exists($lang, config('languages'))) {
            Log::info('LanguageController: Language ' . $lang . ' is valid'); // Log
            Session::put('applocale', $lang);
            App::setLocale($lang);
        } else {
            Log::warning('LanguageController: Language ' . $lang . ' is not valid'); // Log
        }
        return Redirect::back();
    }
}