<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class viewer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user =Auth::user();

            if ($user->user_type === 'viewer') {
                return $next($request);
            } else {
                return to_route('welcome')->with('error', 'Access denied. This page is only accessible to viewers.');
            }
        }

        return to_route('login')->with('error', 'Please log in to access this page.');

    }
}
