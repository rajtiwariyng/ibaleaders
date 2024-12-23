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
use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use App\Models\Referrals;
use App\Models\Tyfcbreferrals;
use App\Models\Onereferrals;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Mail;


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

    public function forgetpassword()
    {

        return view('front.auth.forget-password');
    }

    public function resetpassword()
    {

        return view('front.auth.reset-password');
    }

    public function dashboard()
    {
        $user = auth()->user();
        // Fetch approved connections
        $connections = $user->connections;
        return view('front.dashboard', compact('connections'));
    }

    public function home()
    {

        $user = Auth::user();

        $referralslist = $user->referralslist;
        $tyfcbreferralslist = $user->tyfcbreferralslist;
        // $referralslist=Referrals::with('user')->with('received')->get();
        // echo "<pre>";
        // // echo $sum = array_sum($tyfcbreferralslist->amount);
        // print_r($tyfcbreferralslist);
        // exit;
        $receivedReferralslist = $user->receivedReferralslist;
        $onereferralslists = $user->OneReferralslist;
        $tyfcbreferralstotal = $user->tyfcbreferralstotal;


        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')->orderBy('posts.created_at', 'desc')->get();

        return view('front.home', compact('user', 'posts', 'referralslist', 'tyfcbreferralslist', 'receivedReferralslist', 'onereferralslists', 'tyfcbreferralstotal'));
    }
    public function alliance()
    {
        $upcomingEvents = Event::get();
        $user = auth()->user();
        // Fetch approved connections
        $connections = $user->connections;
        $testimonials = $user->testmonialRelated;

        return view('front.pages.alliance', compact('upcomingEvents', 'connections', 'testimonials'));
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
    public function resetPasswordPost(Request $request)
    {

        $request->validate([
            'current_password' => 'required|string',
            'newpassword' => 'required|string|max:15',
            'renewpassword' => 'required|string|max:15|same:newpassword',
        ]);
        $current_password = Auth::User()->password;
        if (!Hash::check($request->current_password, $current_password)) {
            return response()->json(['errors' => ['current_password_match' => __('Current Password did not matched.')]], 404);
        }
        $user_id = Auth::User()->id;
        $obj_user = User::find(Auth::User()->id);
        $obj_user->password = Hash::make($request->new_password);
        $obj_user->save();
        return response()->json([
            'success' => true,
            'message' => __('Password updated successfully.'),
        ]);
    }
    public function userListReferralType(Request $request)
    {
        $user = auth()->user();
        $userlist = $user->connections;

        // Fetch suggestions (e.g., users not already connected or pending approval)

        if ($request->type == 'outside') {
            $userlist = User::where('id', '!=', $user->id)
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'user')
                        ->where('guard_name', 'web');
                })
                ->whereDoesntHave('receivedConnections', function ($query) use ($user) {
                    $query->where('sender_id', $user->id);
                })
                ->whereDoesntHave('sentConnections', function ($query) use ($user) {
                    $query->where('receiver_id', $user->id);
                })
                ->take(10)
                ->get();
        }
        return response()->json([
            'success' => true,
            'message' => __('successfully'),
            'userlist' => $userlist
        ]);
    }
    public function postReferral(Request $request)
    {

        $request->validate([
            'referraltype' => 'required|string|max:255',
            'referraluser' => 'required|string|max:15',
            'referralstatus' => 'required|string|max:255',
            'referraladdress' => 'required|string|max:255',
            'referraltelephone' => 'required|string|min:6|max:15',
            'referralemail' => 'required|email|max:255',
            'referralcomment' => 'nullable|string|max:255'
        ]);


        Referrals::create([
            'type' => $request->referraltype,
            'received_to' => $request->referraluser,
            'referralstatus' => $request->referralstatus,
            'address' => $request->referraladdress,
            'telephone' => $request->referraltelephone,
            'email' => $request->referralemail,
            'comments' => $request->referralcomment,
            'user_id' => auth()->id(), // Logged-in user's ID

        ]);
        return response()->json(['success' => true, 'message' => 'Referral Added Successfully!']);
    }
    public function tyfcdPostReferral(Request $request)
    {

        $request->validate([
            'tyfcbreferraluser' => 'required|string|max:255',
            'tyfcbreferralamount' => 'required|string|max:15',
            'tyfcbreferralbusinesstype' => 'required|string|max:255',
            'tyfcbreferraltype' => 'required|string|max:255',
            'tyfcbreferralcomment' => 'nullable|string|max:255'
        ]);


        Tyfcbreferrals::create([
            'received_to' => $request->tyfcbreferraluser,
            'amount' => $request->tyfcbreferralamount,
            'businesstype' => $request->tyfcbreferralbusinesstype,
            'type' => $request->tyfcbreferraltype,
            'comments' => $request->tyfcbreferralcomment,
            'user_id' => auth()->id(), // Logged-in user's ID

        ]);
        return response()->json(['success' => true, 'message' => 'TYFCB Referral Added Successfully!']);
    }
    public function onePostReferral(Request $request)
    {

        $request->validate([
            'onereferraluser' => 'required|string|max:255',
            'onereferrallocation' => 'required|string|max:15',
            'onereferralconversation' => 'required|string|max:255',
            'onereferraldate' => 'required|string|max:255'
        ]);


        Onereferrals::create([
            'received_to' => $request->onereferraluser,
            'location' => $request->onereferrallocation,
            'conversation' => $request->onereferralconversation,
            'start_date' => $request->onereferraldate,
            'user_id' => auth()->id(), // Logged-in user's ID

        ]);
        return response()->json(['success' => true, 'message' => 'One To One Referral Added Successfully!']);
    }
    public function forgetPasswordPostMail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
            ], ['email.required' => __('The email field is required.'), 'email.exists' => __('You are not registered with us. Please sign up.')]);
            $token = Str::random(60);
            DB::table('password_reset_tokens')->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]);
            $user = User::where('email', $request->email)->first();
            $data = [
                'token' => $token,
                'mail_from' => 'rajtiwariyng@gmail.com',
                'email' => $request->email,
                'client_name' => $user->name,
                'logo' => asset('front-assets/images/white-logo.png'),
                'subject' => 'Forgot Password',
                'token' => $token,
            ];
            // dispatch(new \App\Jobs\sendForgotPasswordEmail($data))->onQueue('forgot_password_email');
            // SendForgotPasswordEmail::dispatch($data);
            $this->sendForgotPasswordEmail($data);
            return response()->json(['success' => true, 'message' => 'We have e-mailed your password reset link!']);
            // return $this->successResponse([],__('We have e-mailed your password reset link!'));
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'error']);
        }
    }

    function sendForgotPasswordEmail($dataget)
    {


        $datapush = [
            'logo' => $dataget['logo'],
            'token' => $dataget['token'],
        ];
        print_r($dataget);

        Mail::send('email.forgotPaswordMail', ['mailData' => $datapush], function ($message) use ($dataget) {
            $message->to($dataget['email'])->from('noreply@gmail.com', $dataget['client_name'])->subject($dataget['subject']);
        });
    }
    function changePassword(Request $request)
    {
        $token = $request->token;
        return view('front.auth.change-password', compact('token'));
    }
    public function postChangePassword(Request $request, $domain = '')
    {
        $request->validate([
            'token' => 'required',
            'password_confirmation' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.required' => __('The password field is required.'),
            'password.confirmed' => __('The password confirmation does not match.'),
            'password_confirmation.required' => __('The password confirmation field is required.')
        ]);
        $updatePassword = DB::table('password_reset_tokens')->where(['token' => $request->token])->first();
        if ($updatePassword) {
            $user = User::where('email', $updatePassword->email)->update(['password' => Hash::make($request->password)]);
            DB::table('password_reset_tokens')->where(['email' => $updatePassword->email])->delete();
            return response()->json(['success' => true, 'message' => 'Your password has been changed!']);
            // return $this->successResponse([],__('Your password has been changed!'));
        } else {
            return response()->json(['success' => true, 'message' => 'Invalid Token!']);
            //  return $this->errorResponse(__('Invalid Token!'), 400);
        }
    }
}
