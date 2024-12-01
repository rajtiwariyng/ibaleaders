<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
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
        if (Auth::check() && $request->route()->getName() !== 'front.home') {
            return redirect()->route('front.home');
        }

        return $next($request);
    }
}
