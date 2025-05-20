<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, Closure $next)
{
    $user = $request->user();

    if ($user && $user->roles->isEmpty()) {
        $latestRequest = $user->roleRequests()->latest()->first();

        if (!$latestRequest || $latestRequest->status !== 'approved') {
            return redirect()->route('role.request');
        }
    }

    return $next($request);
}

}
