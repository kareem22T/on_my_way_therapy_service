<?php

namespace App\Http\Middleware;

use App\Models\Appointment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ConfirmSessionVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        $appointment = Appointment::find($id);

        if ($appointment->client_id != Auth::guard('client')->user()->id || $appointment->journey == 5)
            return redirect('/');

        return $next($request);
    }
}
