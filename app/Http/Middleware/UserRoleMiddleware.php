<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        info('User request has role: ' . $role);
        info('User has role: ' . Auth::user()->role);
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }
        return response()->json(["You don't have permission to access this page"]);
    }

}
