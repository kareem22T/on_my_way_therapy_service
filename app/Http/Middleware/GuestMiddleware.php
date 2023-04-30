<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('doctor')->check()) {
            return redirect('/therapist'); // Redirect to home page if user is authenticated
        } else if (Auth::guard('client')->check()) {
            return redirect('/client'); // Redirect to home page if user is authenticated
        }

        return $next($request); // Allow access to the route if user is not authenticated
    }
}
