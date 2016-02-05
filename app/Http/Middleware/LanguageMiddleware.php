<?php

namespace ZPos\Http\Middleware;

use Closure;
use App, DB;

class LanguageMiddleware
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
        App::setLocale(DB::table('tutapos_settings')->where('id', 1)->first()->languange);
        return $next($request);
    }
}
