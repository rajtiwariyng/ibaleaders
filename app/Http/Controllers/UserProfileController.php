<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\Event;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Postreact;

class UserProfileController extends Controller
{
    public function profile()
    {   
        $user = Auth::user();
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')->where('user_id', '=', $user->id)->orderBy('posts.created_at', 'desc')->get();
       
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
        $user = auth()->user();
        return view('front.users.edit-bio', compact('user'));
    }

    public function events()
    {
        // return view('front.users.events');
        // $events = Event::latest()->all();
        $events = Event::orderBy('events.created_at', 'desc')->get();
        $user = auth()->user();
        $suggestions = User::where('id', '!=', $user->id)
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
        return view('front.users.events', compact('events','suggestions','user'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::join('users', 'users.id', '=', 'testimonials.user_id')->orderBy('testimonials.created_at', 'desc')->get();
        // $testimonials = Testimonial::whereHas('user', function ($query) use ($user) {
        //     $query->where('id', $user->id);
        // })->get();

        $user = auth()->user();

        

        // Fetch suggestions (e.g., users not already connected or pending approval)
        $suggestions = User::where('id', '!=', $user->id)
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
        return view('front.users.testimonials', compact('testimonials','suggestions','user'));
    }

    public function groupsjoined()
    {
        $user = auth()->user();

        

        // Fetch suggestions (e.g., users not already connected or pending approval)
        $suggestions = User::where('id', '!=', $user->id)
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
        return view('front.users.groups-joined', compact('suggestions','user'));
    }

    public function createEvent()
    {
        $user = auth()->user();

        

        // Fetch suggestions (e.g., users not already connected or pending approval)
        $suggestions = User::where('id', '!=', $user->id)
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
        return view('front.users.create-event', compact('suggestions','user'));
        // $events = Event::user();
        // print_r($events);
        // return view('front.users.create-event', compact('events'));
    }
    public function createEventPost(Request $request)
    {
        $request->validate([
            'eventtitle' => 'required|string|max:255',
            //'eventauthor' => 'required|string|max:15',
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
        //dd($request->eventtitle);
        Event::create([
            'user_id' => auth()->id(), // Logged-in user's ID
            'name' => $request->eventtitle,
            'start_date' => $request->start_date,
            'location' => $request->eventtype,
            'description' => $request->eventdescription,
            'image'=>$path
        ]);

        return response()->json(['success' => true, 'message' => 'Event added successfully!']);
        
    }
    public function createPost()
    {
        $user = auth()->user();

        

        // Fetch suggestions (e.g., users not already connected or pending approval)
        $suggestions = User::where('id', '!=', $user->id)
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
        return view('front.users.create-post', compact('suggestions','user'));
        // $events = Event::user();
        // print_r($events);
        // return view('front.users.create-event', compact('events'));
    }
    public function createPostPost(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'posttitle' => 'required|string|max:255',
                'postdescription' => 'nullable|string|max:255',
                'postimage' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            // Initialize path variable
            $path = "";

            // Handle the file upload if an image is provided
            if ($request->hasFile('postimage')) {
                $file = $request->file('postimage');
                $path = $file->store('post', 'public');
            }

            // Create the post in the database
            Post::create([
                'user_id' => auth()->id(),
                'title' => $request->posttitle,
                'description' => $request->postdescription,
                'image' => $path
            ]);

            // Return success response
            return response()->json(['success' => true, 'message' => 'Post added successfully!']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation error response
            return response()->json(['success' => false, 'message' => 'Validation failed.', 'errors' => $e->errors()], 422);

        } catch (\Exception $e) {
            // Return generic error response
            return response()->json(['success' => false, 'message' => 'An error occurred while adding the post.', 'error' => $e->getMessage()], 500);
        }
    }

    public function createTestimonial(Request $request)
    {
        $customer=$request->id;
        return view('front.users.create-testimonial',compact('customer'));
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
            'description' => $request->testimonialdescription,
            'received_to'=>base64_decode($request->customer_id)
        ]);
        return response()->json(['success' => true, 'message' => 'Testimonial added successfully!']);
        
    }
    public function createEventapi(){
        return response()->json(['success' => true, 'message' => 'Testimonial added successfully!']);
    }
    public function userPostReact(Request $request){
        // echo $request->type;
        $post = Post::findOrFail($request->postid);

    $postreact = $post->postreact()->where('user_id', auth()->id())->first();

    if (!$postreact) {
        Postreact::create([
            'user_id' => auth()->id(), // Logged-in user's ID
            'post_id' => $request->postid,
            'type' => $request->type,
        ]);
        
    }
    else {
        $postreact = Postreact::where('post_id', $request->postid)
            ->where('user_id', auth()->id())
            ->firstOrFail();          

       $updategata= $postreact->update(['type' => $request->type]);
    }
        
         return response()->json(['success' => true, 'message' => 'Post '.$request->type.' successfully!']);
    }
    public function userEventApply(Request $request){
        $eventapply = Eventapply::where('event_id',$request->event_id);

    // Check if the user already liked the post
    if ($eventapply->where('user_id', auth()->id())->exists()) {
        return response()->json(['success' => true, 'message' => 'Event Already Applied!']);
    } 
        Eventapply::create([
            'user_id' => auth()->id(), // Logged-in user's ID
            'event_id' => $request->event_id
        ]);
        
         return response()->json(['success' => true, 'message' => 'Event Apply successfully!']);
    }

}
