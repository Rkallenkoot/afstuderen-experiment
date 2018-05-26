<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UserContextLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('api')->check()) {
            app()->setLocale(Auth::guard('api')->user()->locale);
        }

        return $next($request);
    }
}
