<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Connection;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return view('front.users.connections', compact('connections', 'suggestions'));
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




}