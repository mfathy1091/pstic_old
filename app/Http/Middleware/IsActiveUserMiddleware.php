<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsActiveUserMiddleware
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
        if (auth()->check() && (auth()->user()->status ==0))
        {
            auth()->logout();

            $message = 'Your account has been suspended. Please contact administrator.';

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
