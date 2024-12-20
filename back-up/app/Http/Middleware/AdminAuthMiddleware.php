<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; // Required for authentication
use Illuminate\Http\Request; // Required for handling HTTP requests
use Symfony\Component\HttpFoundation\Response; // Required for HTTP response

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
{
    //logger()->info('Middleware: Roles Passed to Middleware', ['required_roles' => $roles]);

    if (!Auth::guard('admin')->check()) {
        //logger()->warning('Middleware: User Not Authenticated');
        return redirect()->route('admin.login')->withErrors('Please log in as an admin.');
    }

    $user = Auth::guard('admin')->user();

    /*logger()->info('Middleware: User Authenticated', [
        'email' => $user->email,
        'roles' => $user->getRoleNames()->toArray(),
    ]);*/

    if (empty($roles) || !$user->hasAnyRole($roles)) {
        /*logger()->warning('Middleware: Role Check Failed', [
            'email' => $user->email,
            'roles' => $user->getRoleNames()->toArray(),
            'required_roles' => $roles,
        ]);*/
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->withErrors('You do not have admin access.');
    }

    return $next($request);
}


    }

