<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Connection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    try {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Check credentials
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }

        // Retrieve the user
        $user = Auth::user();

        // Delete existing tokens for the user (enforce single active token)
        //$user->tokens()->delete();

        // Generate a new token with expiration time
        //$token = $user->createToken('API Token', ['*'], Carbon::now()->addHours(2))->plainTextToken;
        $token = $user->createToken('API Token')->plainTextToken;
        $userData['token'] = $token;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'user' => $userData,
        ], 200);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An unexpected error occurred.',
            'error' => $e->getMessage(),
        ], 500);
    }
    }

    public function logout(Request $request)
    {
    try {
        // Revoke the current token
        $request->user()->currentAccessToken()->delete();
        Session::flush();
        Cache::forget('user_' . $request->user()->id);
        auth()->logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful.',
        ], 200);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An unexpected error occurred during logout.',
            'error' => $e->getMessage(),
        ], 500);
    }
    }


    public function userslist(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $users = User::where('id', '!=', auth()->id()) 
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user'); 
            })
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'User list fetched successfully.',
            'data' => $users
        ], 200);
    }



    public function searchUser(Request $request)
    {
        try {
            $authUserId = auth()->id();

            // Validate input
            $request->validate([
                'query' => 'required|string|max:255',
                'per_page' => 'integer|min:1',
            ]);

            $query = $request->get('query');
            $perPage = $request->get('per_page', 10);

            $users = User::where('id', '!=', $authUserId)
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%')
                      ->orWhere('email', 'LIKE', '%' . $query . '%')
                      ->orWhere('industry', 'LIKE', '%' . $query . '%');
                })
                ->paginate($perPage, ['id', 'name', 'email', 'industry', 'profile_image']);

            // Add connection status to each user
            $users->getCollection()->transform(function ($user) use ($authUserId) {
                $connection = Connection::where(function ($q) use ($authUserId, $user) {
                    $q->where('sender_id', $authUserId)
                      ->where('receiver_id', $user->id);
                })->orWhere(function ($q) use ($authUserId, $user) {
                    $q->where('sender_id', $user->id)
                      ->where('receiver_id', $authUserId);
                })->first();

                $user->connection_status = $connection ? $connection->status : 'none';
                return $user;
            });

            return response()->json([
                'success' => true,
                'message' => 'Users retrieved successfully.',
                'data' => $users,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function sendOtp(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);
    
            // Generate a 6-digit OTP
            $otp = random_int(100000, 999999);
    
            // Save OTP to the database
            DB::table('password_reset_otps')->updateOrInsert(
                ['email' => $request->email],
                [
                    'otp' => $otp,
                    'created_at' => now(),
                    'expires_at' => Carbon::now()->addMinutes(5), // OTP valid for 5 minutes
                ]
            );
            $data = [
                'otp' => $otp,
                'mail_from' => 'rajtiwariyng@gmail.com',
                // 'email' => $request->email,
                // 'client_name' => $user->name,
                'logo' => asset('front-assets/images/white-logo.png'),
                'subject' => 'Forgot Password'
            ];
    
            // Send OTP via email
            Mail::to($request->email)->send(new \App\Mail\SendOtpMail($data));
            return response()->json([
                'success' => true,
                'message' => 'OTP sent to your email.',
                'data' => $data,
            ], 200);
           
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function validateOtp(Request $request)
    {
        try {
        
            $request->validate([
                'email' => 'required|email|exists:password_reset_otps,email',
                'otp' => 'required|numeric',
            ]);
            $otpRecord = DB::table('password_reset_otps')
                        ->where('email', $request->email)
                        ->where('otp', $request->otp)
                        ->first();

            if (!$otpRecord) {
                return response()->json(['success' => false,'message' => 'Invalid OTP.'], 400);
            }

            if (Carbon::now()->greaterThan(Carbon::parse($otpRecord->expires_at))) {
                return response()->json(['success' => false,'message' => 'OTP has expired.'], 400);
            }
            
            $obj = base64_encode($request->email.','.$request->otp);
            // OTP is valid, allow password reset
            // $routeurl=URL::route("front.changepassword", [$obj]);
            $jsondata=[
                "otp"=>$request->otp,
                "email"=>$request->email
            ];
            return response()->json([
                'success' => true,
                'message' => 'OTP verified. Proceed to reset password.',
                'data' => $jsondata,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
        
    }
    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'otp' => 'required',
                'email' => 'required',
                'password_confirmation' => 'required',
                'password' => 'required|string|min:6|confirmed',
            ], [
                'password.required' => __('The password field is required.'),
                'password.confirmed' => __('The password confirmation does not match.'),
                'password_confirmation.required' => __('The password confirmation field is required.')
            ]);
       
            // Validate OTP and its association with the email
            $otpRecord = DB::table('password_reset_otps')
                        ->where('email', $request->email)
                        ->where('otp', $request->otp)
                        ->first();
    
            if (!$otpRecord) {
                return response()->json(['success' => false,'message' => 'Invalid or mismatched OTP.'], 400);
            }
    
            if (Carbon::now()->greaterThan(Carbon::parse($otpRecord->expires_at))) {
                return response()->json(['success' => false,'message' => 'OTP has expired.'], 400);
            }
    
            // Reset the password
            $userdata=DB::table('users')->where('email', $otpRecord->email)->update([
                'password' => bcrypt($request->password),
            ]);
    
            // Delete the OTP record after successful reset
            DB::table('password_reset_otps')->where('email', $otpRecord->email)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Password reset successfully.',
                'data' => [
                    "email"=>$otpRecord->email
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
