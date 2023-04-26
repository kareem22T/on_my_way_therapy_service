<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TherapistPaymentVistors
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
            if ($user->payment_registered == 1) {
                return redirect('/therapist');
            } else if (!$user->information_registerd) {
                return redirect('/therapist/information');
            }
        } else {
            return redirect('/therapist/register');
        }
        return $next($request);
    }
}