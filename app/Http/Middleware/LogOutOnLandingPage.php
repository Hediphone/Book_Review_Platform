<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutOnLandingPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the current route is the landing page and the user is logged in
        if ($request->routeIs('landing-page') && Auth::check()) {
            // Log the user out
            Auth::logout();
            // Invalidate the session
            $request->session()->invalidate();
            // Regenerate the session token
            $request->session()->regenerateToken();
        }

        return $next($request);
    }

}
