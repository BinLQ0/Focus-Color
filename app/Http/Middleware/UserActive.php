<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** Check Authenticated */
        if (auth()->check()) {

            /** Update User Time */
            auth()->user()->update([
                'last_seen_at'  => now(),
                'attempt_ip'    => $request->ip()
            ]);
        }
        return $next($request);
    }
}
