<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class purchaser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            $user = auth()->user();
            if ($user->user_type === 'purchase'){
                return $next($request);
            }else{
                return to_route('welcome')->with('error', 'Access denied. Please create an account to continue.');
            }
        }else{
            return to_route('login');
        }
    }
}
