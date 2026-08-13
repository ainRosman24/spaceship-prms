<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsCrewLead
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and is a Crew Lead
        if (auth()->check() && auth()->user()->isCrewLead()) {
            return $next($request);
        }

        // Redirect non-admins to the passenger dashboard with an error
        return redirect()->route('passenger.dashboard')->with('error', 'Access Denied. Authorized Crew Leads only.');
    }
}