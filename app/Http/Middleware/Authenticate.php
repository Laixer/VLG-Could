<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
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
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'unauthorized 1'], 401);
            } else {
                return redirect()->guest('/auth');
            }
        }

        if (!Auth::guard($guard)->user()->isActive()) {
            Auth::logout();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'forbidden'], 403);
            } else {
                return redirect()->guest('/unauth');
            }
        }

        if (!Auth::guard($guard)->user()->canRead()) {
            Auth::logout();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'forbidden'], 403);
            } else {
                return redirect()->guest('/unauth');
            }
        }

        return $next($request);
    }
}
