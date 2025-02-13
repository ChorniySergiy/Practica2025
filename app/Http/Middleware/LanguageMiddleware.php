<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {   
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // Якщо мови нема в сесії, встановлюємо стандартну 'uk'
            Session::put('locale', 'uk');
            App::setLocale('uk');
        }

        // Додамо дебаг, щоб бачити значення сесії
        dd(Session::get('locale'));
        
        return $next($request);
    }
}
