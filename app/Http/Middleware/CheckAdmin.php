<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        // this middleware is used to check if the role of the user is admin
        if (Auth::user()->role != 'admin') {
            abort(403); // if role is not admin, then show forbidden page
        }
        return $next($request);
    }
}
