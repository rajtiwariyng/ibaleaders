<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    /**
     * Show the login page for admins.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginPage()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle the login process for admins.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
{
    // Validate the request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to log in using the 'admin' guard
    if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
        $user = Auth::guard('admin')->user();

        // Check if the user has any of the required roles
        if (!$user->hasAnyRole(['admin', 'superadmin'])) { // Corrected to use `hasAnyRole`
            Auth::guard('admin')->logout();
            return back()->withErrors([
                'email' => 'You do not have admin access-c.',
            ]);
        }
        
        // Redirect to the admin dashboard on successful login
        return redirect()->route('admin.dashboard');
    }

    // Redirect back with an error message on failure
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records or you do not have admin access.',
    ])->withInput($request->only('email'));
}

}
