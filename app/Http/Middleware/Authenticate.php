<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if ($request->is('doctor') || $request->is('doctor/*'))
                return route('doctor.login');

            if ($request->is('client') || $request->is('client/*'))
                return route('client.login');

            if ($request->is('admin') || $request->is('admin/*'))
                return route('admin.login');
        }

        return $request->expectsJson() ? null : route('site.home');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if ($jwt = $request->token) {
            $request->headers->set('Authorization', 'Bearer ' . $jwt);
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }
}
