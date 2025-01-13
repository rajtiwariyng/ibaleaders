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
use App\Models\Postreact;
use App\Models\Event;
use App\Models\Eventapply;

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
                'postdescription' => 'required|string|max:255',
                'postimage' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
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

        // Fetch posts with user details
        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($post) use ($user) {
                return [
                    'id' => $post->id,
                    'image' => $post->image,
                    'description' => $post->description,
                    'post_for' => $post->post_for,
                    'status' => $post->status,
                    'created_at' => $post->created_at->toDateTimeString(),
                    'updated_at' => $post->updated_at->toDateTimeString(),
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'industry' => $user->industry,
                        'profile_image' => $user->profile_image,
                    ],
                    'postreactcount'=>Postreact::where('post_id', $post->id)->count(),
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'User posts fetched successfully.',
            'data' => $posts,
        ], 200);
    }

    public function sendPostReact(Request $request)
    {
        
        $user = Auth::user();
        $post = Post::findOrFail($request->post_id);
        
        $postreact = $post->postreact()->where('user_id',$user->id)->first();
        
        if (!$postreact) {
            Postreact::create([
                'user_id' => $user->id, // Logged-in user's ID
                'post_id' => $request->post_id,
                'type' => $request->type,
            ]);
            
        }
        else {
            $postreact = Postreact::where('post_id', $request->post_id)
                ->where('user_id', auth()->id())
                ->firstOrFail();          
    
           $updategata= $postreact->update(['type' => $request->type]);
        }
        
        $datajson=[
            'subject'=>'Liked Your Post',
            'message'=>'Liked Your Post',
            'type' => 'Postreact',
            'action_id' => $request->post_id,
            'received_id'=>$post->user_id,
            'user_id' => auth()->id(),
        ];
        $notificationdata=[
            'type' => 'Postreact',
            'data' => json_encode($datajson),
            'action_id' => $request->post_id,
            'received_id'=>$post->user_id,
            'user_id' => auth()->id(), // Logged-in user's ID
    
        ];
        createNotificationsData($notificationdata);
        return response()->json([
            'success' => true,
            'message' => 'Post React added successfully!',
            'data' => $postreact,
        ], 201);
    }

    public function eventlist(Request $request)
    {
       
        // Get authenticated user
        $user = Auth::user();
// echo "tt";
// exit;
        // Fetch events with user details
        $events = Event::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($event) use ($user) {
                return [
                    'id' => $event->id,
                    'name' => $event->name,
                    'location'=>$event->location,
                    'start_date' => $event->start_date->toDateTimeString(),
                    'description' => $event->description,
                    'author' => $event->author,
                    'type' => $event->type,
                    'status' => $event->status,
                    'created_at' => $event->created_at->toDateTimeString(),
                    'updated_at' => $event->updated_at->toDateTimeString(),
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'industry' => $user->industry,
                        'profile_image' => $user->profile_image,
                    ],
                    'eventcount'=>Eventapply::where('event_id', $event->id)->count(),
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'User events fetched successfully.',
            'data' => $events,
        ], 200);
    }


}
