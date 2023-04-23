<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TherapistInformationVisitors
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
            if ($user->information_registerd == 1) {
                return redirect('/therapist/payment');
            } else if (!$user->verified) {
                return redirect('/therapist/verify');
            }
        } else {
            return redirect('/therapist/register');
        }

        return $next($request);
    }
}