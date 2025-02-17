<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->cookie('locale', 'ua');

        // Перевіряємо, чи підтримується така мова
        if (in_array($locale, ['en', 'ua'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
