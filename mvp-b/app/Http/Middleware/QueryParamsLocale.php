<?php

namespace App\Http\Middleware;

use Closure;

class QueryParamsLocale
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
        if (request('locale')) {
            app()->setLocale(request('locale'));
        }
        return $next($request);
    }
}
