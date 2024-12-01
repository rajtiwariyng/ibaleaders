<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class AdminEventController extends Controller
{
    // Show the form to create an event
    public function create()
    {
        $users = User::all(); // Get all users for assignment
        return view('admin.events.create', compact('users'));
    }

    // Store a new event
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        Event::create([
            'name' => $request->name,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    // List all events
    public function index()
    {
        $events = Event::with('user')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function edit(Event $event)
    {
        $users = User::all(); // Fetch all users for assignment
        return view('admin.events.edit', compact('event', 'users'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $event->update([
            'name' => $request->name,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function changeStatus(Event $event, Request $request)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $event->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event status updated successfully.');
    }



    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}