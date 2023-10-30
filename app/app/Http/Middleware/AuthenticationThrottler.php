<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationThrottler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (RateLimiter::tooManyAttempts('authentication-request:'.$request->ip(), 5)) {
            $seconds = RateLimiter::availableIn('authentication-request:'.$request->ip());
            response(['error' => 'To many request. Please try again after ' . $seconds . ' seconds'], 429)->send();
        }
        return $next($request);
    }
}
