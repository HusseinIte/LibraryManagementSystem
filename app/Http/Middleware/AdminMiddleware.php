<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'Admin') {
            return $next($request);
        }
        $message = 'Unauthorized access. Admin privileges are required.';
        if ($request->expectsJson()) {
            return response()->json([
                'error' => $message,
            ], 403); // 403 Forbidden status code
        }

    }
}
