<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\Connection;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class ApiConnectionController extends Controller
{
    public function showConnections(Request $request)
    {
        try {
            // Get the authenticated user
            $user = auth()->user();

            // Validate authentication
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated.',
                ], 401);
            }

            // Define pagination parameters
            $connectionsPerPage = $request->get('connections_per_page', 10);
            $suggestionsPerPage = $request->get('suggestions_per_page', 10);

            // Fetch paginated connections
            $connections = Cache::remember("user_{$user->id}_connections_page_{$request->get('page', 1)}", 3600, function () use ($user, $connectionsPerPage) {
                return $user->connections()->paginate($connectionsPerPage);
            });

            // Fetch paginated suggestions
            $suggestions = Cache::remember("user_{$user->id}_suggestions_page_{$request->get('page', 1)}", 3600, function () use ($user, $suggestionsPerPage) {
                return User::where('id', '!=', $user->id)
                    ->whereHas('roles', function ($query) {
                        $query->where('name', 'user')->where('guard_name', 'web');
                    })
                    ->whereDoesntHave('receivedConnections', function ($query) use ($user) {
                        $query->where('sender_id', $user->id);
                    })
                    ->whereDoesntHave('sentConnections', function ($query) use ($user) {
                        $query->where('receiver_id', $user->id);
                    })
                    ->paginate($suggestionsPerPage);
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
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function sendConnectionRequest(Request $request)
    { 
        try {

            $senderId = auth()->id();
            $receiverId = $request->receiver_id;

            // Validate input
            $request->validate([
                'receiver_id' => 'required|exists:users,id',
            ]);

            if ($senderId == $receiverId) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot send a connection request to yourself.',
            ], 400);
        }

            // Check if connection already exists
            $existing = Connection::where(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $senderId)
                    ->where('receiver_id', $receiverId);
            })->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', $senderId);
            })->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Connection already exists.',
                ], 400);
            }

            // Create new connection
            Connection::create([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Connection request sent successfully!',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function approveConnectionRequest(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'connection_id' => 'required|exists:connections,id',
            ]);

            // Retrieve the connection request
            $connection = Connection::where('id', $request->connection_id)
                ->where('receiver_id', auth()->id())
                ->where('status', 'pending')
                ->first();

            // Check if the connection exists and is valid
            if (!$connection) {
                return response()->json([
                    'success' => false,
                    'message' => 'Connection request not found or already processed.',
                ], 404);
            }

            // Update connection status to approved
            $connection->update(['status' => 'approved']);

            return response()->json([
                'success' => true,
                'message' => 'Connection approved successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function rejectConnectionRequest(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'connection_id' => 'required|exists:connections,id',
            ]);

            // Retrieve the connection request
            $connection = Connection::where('id', $request->connection_id)
                ->where('receiver_id', auth()->id())
                ->where('status', 'pending')
                ->first();

            // Check if the connection exists and is valid
            if (!$connection) {
                return response()->json([
                    'success' => false,
                    'message' => 'Connection request not found or already processed.',
                ], 404);
            }

            // Update connection status to declined
            $connection->update(['status' => 'declined']);

            return response()->json([
                'success' => true,
                'message' => 'Connection declined successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
  
    public function pendingRequestList(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);
            $pendingRequests = Connection::where('receiver_id', auth()->id())
                ->where('status', 'pending')
                ->with('sender')
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'message' => 'Pending requests fetched successfully.',
                'data' => $pendingRequests,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching pending requests.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function sendRequestList(Request $request)
    {
        try {
            $userId = auth()->id();
            $perPage = $request->get('per_page', 10);

            $sentRequests = Connection::where('sender_id', $userId)
                ->where('status', 'pending')
                ->with('receiver:id,name,email,industry,profile_image')
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'message' => 'Sent requests retrieved successfully.',
                'data' => $sentRequests,
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
