<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->cookie('lang') == null) {
            if (isset($_COOKIE['lang'])) {
                App::setLocale($_COOKIE['lang']);
            } else {
                setcookie('lang', 'en', time() + (60 * 60 * 24 * 30), '/');
                App::setLocale('en');
            }
        } else {
            App::setLocale($request->cookie('lang'));
        }

        return $next($request);
    }
}
