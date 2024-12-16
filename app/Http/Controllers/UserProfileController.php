<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;
use App\Models\Post;
use App\Models\Testimonial;

class UserProfileController extends Controller
{
    public function profile()
    {   
        $user = Auth::user();
        $posts = Post::all();
       
        return view('front.users.profile', compact('user','posts'));
    }

    public function profiledetails()
    {
        $user = Auth::user();
        return view('front.users.profile-details', compact('user'));
    }
     
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Add validation rules for the fields
        $request->validate([
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

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    
    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Handle the uploaded file
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $path = $file->store('profiles', 'public');  // Store the file in the 'public' disk

            // Save the file path to the user's record or return the file URL
            $user = auth()->user();
            $user->profile_image = $path;
            $user->save();

            return response()->json([
                'success' => true,
                'profile_image_url' => asset('storage/' . $path),
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No file uploaded']);
    }



    public function connections()
    {
        return view('front.users.connections');
    }

    public function editbio()
    {
        return view('front.users.edit-bio');
    }

    public function events()
    {
        // return view('front.users.events');
        $events = Event::all();
        return view('front.users.events', compact('events'));
    }

    public function testimonials()
    {
        return view('front.users.testimonials');
    }

    public function groupsjoined()
    {
        return view('front.users.groups-joined');
    }

    public function createEvent()
    {
        return view('front.users.create-event');
        // $events = Event::user();
        // print_r($events);
        // return view('front.users.create-event', compact('events'));
    }
    public function createEventPost(Request $request)
    {
        $request->validate([
            'eventtitle' => 'required|string|max:255',
            'eventauthor' => 'required|string|max:15',
            'eventtype' => 'required|string|max:255',            
            'eventdescription' => 'nullable|string|max:255',
            'eventimage' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $path="";
        if ($request->hasFile('eventimage')) {
            $file = $request->file('eventimage');
            $path = $file->store('event', 'public');  // Store the file in the 'public' disk

            // Save the file path to the user's record or return the file URL
            // $user = auth()->user();
            // $user->eventimage = $path;
            // $user->save();

            // return response()->json([
            //     'success' => true,
            //     'profile_image_url' => asset('storage/' . $path),
            // ]);
        }
        Event::create([
            'user_id' => auth()->id(), // Logged-in user's ID
            'name' => $request->eventtitle,
            'author' => $request->eventauthor,
            'type' => $request->eventtype,
            'description' => $request->eventdescription,
            'image'=>$path
        ]);

        return response()->json(['success' => false, 'message' => 'Event added successfully!']);
        
    }
    public function createPost()
    {
        return view('front.users.create-post');
        // $events = Event::user();
        // print_r($events);
        // return view('front.users.create-event', compact('events'));
    }
    public function createPostPost(Request $request)
    {
        $request->validate([
            'posttitle' => 'required|string|max:255',          
            'postdescription' => 'nullable|string|max:255',
            'postimage' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $path="";
        if ($request->hasFile('postimage')) {
            $file = $request->file('postimage');
            $path = $file->store('post', 'public');  // Store the file in the 'public' disk

            // Save the file path to the user's record or return the file URL
            // $user = auth()->user();
            // $user->eventimage = $path;
            // $user->save();

            // return response()->json([
            //     'success' => true,
            //     'profile_image_url' => asset('storage/' . $path),
            // ]);
        }
        Post::create([
            'user_id' => auth()->id(), // Logged-in user's ID
            'title' => $request->posttitle,
            'description' => $request->postdescription,
            'image'=>$path
        ]);
        return response()->json(['success' => false, 'message' => 'Post added successfully!']);
        
    }
    public function createTestimonial()
    {
        return view('front.users.create-testimonial');
        // $events = Event::user();
        // print_r($events);
        // return view('front.users.create-event', compact('events'));
    }
    public function createTestimonialPost(Request $request)
    {
        
        $request->validate([
            'testimonialtitle' => 'required|string|max:255',
            'testimonialauthor' => 'required|string|max:15',
            'testimonialtype' => 'required|string|max:255',            
            'testimonialdescription' => 'nullable|string|max:255'
        ]);
        
       
        Testimonial::create([
            'user_id' => auth()->id(), // Logged-in user's ID
            'title' => $request->testimonialtitle,
            'author' => $request->testimonialauthor,
            'type' => $request->testimonialtype,
            'description' => $request->testimonialdescription
        ]);
        return response()->json(['success' => false, 'message' => 'Testimonial added successfully!']);
        
    }
}
