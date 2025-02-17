<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switchLang($locale)
    {
        // Перевіряємо, чи підтримується така мова
        if (!in_array($locale, ['en', 'ua'])) {
            abort(400); // Невірний запит, якщо мова не підтримується
        }

        // Встановлюємо мову в додатку
        App::setLocale($locale);

        // Зберігаємо вибір мови в Cookie на 1 рік
        return Redirect::back()->withCookie(cookie()->forever('locale', $locale));
    }
}
