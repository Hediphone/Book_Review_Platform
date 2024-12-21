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
        // Check if the user is visiting the homepage and is logged in
        if ($request->is('/') && Auth::check()) {
            // Log the user out
            Auth::logout();
            // Optionally, invalidate the session
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // Allow the request to continue
        return $next($request);
    }
}
