<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectWithMessageAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user() == null) {
            return redirect('/login')->with('error', 'You must be logged in to do that!');
        }
        if (!Auth::user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'You must be an admin to do that!');
        }

        return $next($request);
    }
}
