<?php

namespace App\Http\Middleware;

use Closure;

class Client
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
        if (! (auth()->user()->isClient() || auth()->user()->isAdmin()) ) {
            throw new \Illuminate\Auth\Access\AuthorizationException;
        }
        return $next($request);
    }
}
