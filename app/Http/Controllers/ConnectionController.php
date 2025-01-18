<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Connection;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Models\Post;
use App\Models\Postreact;

class ConnectionController extends Controller
{
    public function showConnections()
    {
        $user = auth()->user();

        // Fetch approved connections
        $connections = $user->connections;

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

        return view('front.users.connections', compact('connections', 'suggestions','user'));
    }


    public function sendConnectionRequest(Request $request)
    {
        $senderId = auth()->id();
        $receiverId = $request->receiver_id;

        // Check if connection already exists
        $existing = Connection::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $senderId);
        })->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Connection already exists.');
        }

        Connection::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Connection request sent successfully!');
    }


    public function approveConnectionRequest(Request $request)
    {
        $request->validate([
            'connection_id' => 'required|exists:connections,id',
        ]);

        $connection = Connection::where('id', $request->connection_id)
            ->where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        $connection->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Connection approved successfully!');
    }

    public function rejectConnectionRequest(Request $request)
    {
        $request->validate([
            'connection_id' => 'required|exists:connections,id',
        ]);

        $connection = Connection::where('id', $request->connection_id)
            ->where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        $connection->update(['status' => 'declined']);

        return redirect()->back()->with('success', 'Connection Declined successfully!');
    }

    public function userConnectionProfile(Request $request)
    {
        // echo $request->id;
        $userid= base64_decode($request->id);
        // exit;
        $user = User::where('id', $userid)->first();
        // echo "<pre>";
        // print_r($user);
        // exit;
        $posts = Post::with('byuser')->where('user_id', $userid)->orderBy('posts.created_at', 'desc')->get();
        $customer = $request->id;

        return view('front.users.userprofile', compact('user', 'posts', 'customer'));
    }
    function userConnectionRemove(Request $request){
        $connection = Connection::where('sender_id', $request->user_id)
            ->where('receiver_id', auth()->id())
            ->firstOrFail();
       $connection->delete();
       return response()->json(['success' => true, 'message' => 'User Connection Removed successfully!']);    
    }

    function userConnectionBlock(Request $request){
        $connection = Connection::where('sender_id', $request->user_id)
            ->where('receiver_id', auth()->id())
            ->firstOrFail();
       $connection->update(['status' => 'block']);
       return response()->json(['success' => true, 'message' => 'User Connection Block successfully!']);    
    }
}
