<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

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

    public function signup(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Generate a token for the user
        $token = $user->createToken('API Token')->plainTextToken;

        // Return success response
        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function userslist()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user'); // Filter users with 'user' role
        })->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ], 200);
    }
}
