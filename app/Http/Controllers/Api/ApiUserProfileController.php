<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\Connection;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class ApiUserProfileController extends Controller
{
    public function profile()
    {
        // Get authenticated user
        $user = Auth::user();

        return response()->json([
            'success' => true,
            'message' => 'User profile fetched successfully.',
            'data' => $user,
        ], 200);
    }

    public function profiledetails()
    {
        // Get authenticated user
        $user = Auth::user(6);

        return response()->json([
            'success' => true,
            'message' => 'User profile details fetched successfully.',
            'data' => $user,
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();

            // Validate the request
            $validator = Validator::make($request->all(), [
                'industry' => 'nullable|string|max:255',
                'mobile_number' => 'nullable|string|max:15',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'pin_code' => 'nullable|string|max:10',
                'brand_name' => 'nullable|string|max:255',
                'brand_logo' => 'nullable|string|max:255',
                'business_bio' => 'nullable|string',
                'keywords' => 'nullable|string',
                'years_in_business' => 'nullable|string|max:255',
                'previous_jobs' => 'nullable|string|max:255',
                'spouse' => 'nullable|string|max:255',
                'children' => 'nullable|string|max:255',
                'hobbies' => 'nullable|string|max:255',
                'skills' => 'nullable|string|max:255',
                'city_residence' => 'nullable|string|max:255',
                'years_in_city' => 'nullable|string|max:255',
                'burning_desire' => 'nullable|string|max:255',
                'key_success' => 'nullable|string|max:255',
                'gains_profile' => 'nullable|string|max:255',
                'ambitions' => 'nullable|string|max:255',
                'achievements' => 'nullable|string|max:255',
                'tops_profile' => 'nullable|string|max:255',
                'ideal_referrals' => 'nullable|string|max:255',
                'best_product' => 'nullable|string|max:255',
                'networking_groups' => 'nullable|string|max:255',
            ]);

            // Check validation
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error.',
                    'errors' => $validator->errors(),
                ], 422); // HTTP 422 Unprocessable Entity
            }

            // Update user fields
            $user->update($request->only([
                'industry',
                'mobile_number',
                'address',
                'city',
                'state',
                'pin_code',
                'brand_name',
                'brand_logo',
                'business_bio',
                'keywords',
                'years_in_business',
                'previous_jobs',
                'spouse',
                'children',
                'hobbies',
                'skills',
                'city_residence',
                'years_in_city',
                'burning_desire',
                'key_success',
                'gains_profile',
                'ambitions',
                'achievements',
                'tops_profile',
                'ideal_referrals',
                'best_product',
                'networking_groups',
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'data' => $user,
            ], 200); // HTTP 200 OK
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500); // HTTP 500 Internal Server Error
        }
    }


    public function updateProfileImage(Request $request)
    {
        try {
            // Validate the uploaded file
            $validator = Validator::make($request->all(), [
                'profile_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Handle the uploaded file
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $path = $file->store('profiles', 'public'); // Store file in 'profiles' directory on 'public' disk

                // Save the file path to the user's record
                $user = auth()->user();

                // Optionally delete the old profile image
                if ($user->profile_image) {
                    Storage::disk('public')->delete($user->profile_image);
                }

                $user->profile_image = $path;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Profile image updated successfully.',
                    'profile_image_url' => asset('storage/' . $path),
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'No file uploaded.',
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function createPost(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'posttitle' => 'required|string|max:255',
                'postdescription' => 'nullable|string|max:255',
                'postimage' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Handle file upload
            $path = null;
            if ($request->hasFile('postimage')) {
                $file = $request->file('postimage');
                $path = $file->store('post', 'public');
            }

            // Create the post
            $post = Post::create([
                'user_id' => auth()->id(),
                'title' => $request->posttitle,
                'description' => $request->postdescription,
                'image' => $path,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post added successfully!',
                'data' => $post,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function postlist(Request $request)
    {
        // Get authenticated user
        $user = Auth::user();

        // Fetch posts of the user, ordered by creation date
        $posts = Post::where('user_id', $user->id)
                     ->orderBy('created_at', 'desc')
                     ->get();

        return response()->json([
            'success' => true,
            'message' => 'User posts fetched successfully.',
            'data' => $posts,
        ], 200);
    }

    public function showConnections()
{
    // Get the authenticated user
    $user = auth()->user();

    // Validate that the user exists
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not authenticated.',
        ], 401);
    }

    // Use caching to store and retrieve connections and suggestions
    $cacheKeyConnections = "user_{$user->id}_connections";
    $cacheKeySuggestions = "user_{$user->id}_suggestions";

    // Fetch connections from cache or database
    $connections = Cache::remember($cacheKeyConnections, 3600, function () use ($user) {
        return $user->connections; // Assuming `connections` is a relationship
    });

    // Fetch suggestions from cache or database
    $suggestions = Cache::remember($cacheKeySuggestions, 3600, function () use ($user) {
        return User::where('id', '!=', $user->id)
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
    });

    // Return response as JSON
    return response()->json([
        'success' => true,
        'message' => 'Connections and suggestions fetched successfully.',
        'data' => [
            'connections' => $connections,
            'suggestions' => $suggestions,
        ],
    ], 200);
}



}
