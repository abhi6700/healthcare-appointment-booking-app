<?php

namespace App\Http\Middleware;

use App\Models\HealthcareProfessional;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HpAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
         if (!$user) {
        return response()->json(['message' => 'Token not provided'], 401);
    }

    if (!$user instanceof HealthcareProfessional) {
        return response()->json(['message' => 'Unauthorized - Not a Healthcare Professional'], 403);
    }

        return $next($request);
    }
}
