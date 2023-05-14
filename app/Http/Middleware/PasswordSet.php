<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PasswordSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('doctor')->check()) {
            $user = Auth::guard('doctor')->user();
            if ($user->password_set) {
                return redirect('/therapist/information');
            }
        } else {
            return redirect('/therapist/register');
        }

        return $next($request);
    }
}