<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use App\Models\Event;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Connection;
use Spatie\Permission\Models\Role;

class FrontendLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('front.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            if ($user->hasRole('user')) {
 
                return redirect()->route('front.home');
            }

            Auth::logout();

            throw ValidationException::withMessages([
                'email' => ['You are not authorized to access this page.'],
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('front.login');
    }

    public function forgetpassword(){

      return view('front.auth.forget-password');  
    }

     public function resetpassword(){

      return view('front.auth.reset-password');  
    } 

    public function dashboard(){

      return view('front.dashboard');  
    }
     
    public function home(){

      return view('front.home');  
    }
    public function alliance()
    {
        $upcomingEvents = Event::where('start_date', '>=', Carbon::now())
        ->orderBy('start_date', 'asc')
        ->get();
        return view('front.pages.alliance', compact('upcomingEvents'));
    }

    public function reports()
    {
        return view('front.pages.reports');
    }

    public function aboutus()
    {
        return view('front.pages.about-us');
    }

    public function browserpolicy()
    {
        return view('front.pages.browser-policy');
    }

    public function privacypolicy()
    {
        return view('front.pages.privacy-policy');
    }

    public function privacysettings()
    {
        return view('front.pages.privacy-settings');
    }

    public function termsofuse()
    {
        return view('front.pages.terms-of-use');
    }

    public function chats()
    {
        return view('front.chats');
    }

    public function notifications(Request $request)
    {
        $pendingRequests = Connection::where('receiver_id', auth()->id())
        ->where('status', 'pending')
        ->with('sender') // Assuming 'sender' is a relation for the sender's user details
        ->get();
        //dd($pendingRequests);
        return view('front.notifications', compact('pendingRequests'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::role('user') // Use Spatie Permission to filter users with "user" role
            ->where('name', 'LIKE', '%' . $query . '%')
            ->take(5)
            ->get(['name']); // Select only the name field for lighter response

        return response()->json($users);
    }

    
}   


