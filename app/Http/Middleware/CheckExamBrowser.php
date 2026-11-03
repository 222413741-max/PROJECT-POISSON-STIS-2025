<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckExamBrowser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');

        if (strpos($userAgent, 'ExamBrowserPoi') === false) {
            // Redirect or return error response if the browser is not ExamBrowser
            return abort(404, 'Anda diharuskan menggunakan exam browser');
        }

        return $next($request);
    }
}
