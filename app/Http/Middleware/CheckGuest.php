<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckGuest
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
        // this middleware checks whether user is guess or already logged in
        if (Auth::guest()) {
            return redirect('/login');  // will redirect to login page if user is not logged in yet (a guest)
        }

        return $next($request);
    }
}
