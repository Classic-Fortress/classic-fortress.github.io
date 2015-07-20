<?php

namespace CF\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if( ! Auth::user()->isAdmin()) {
			abort(403);
		}

        return $next($request);
    }
}
