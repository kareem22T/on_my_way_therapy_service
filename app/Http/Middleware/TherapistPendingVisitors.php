<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TherapistPendingVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $therapist = Auth::guard('doctor')->user();
        if (
            $therapist->verified &&
            $therapist->information_registerd &&
            $therapist->payment_registered &&
            !$therapist->approved
        ) {
            return $next($request);
        } else {
            return redirect('/therapist/register');
        }
        return $next($request);
    }
}
