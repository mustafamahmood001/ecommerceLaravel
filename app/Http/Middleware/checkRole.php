<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('indexWeb')->with('message', 'Warning unauthorized')->setStatusCode(301);
        }

        // Check if the authenticated user has the 'admin' role
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('indexWeb')->with('message', 'Warning unauthorized')->setStatusCode(301);
        }
      
        return $next($request);
    }
}
