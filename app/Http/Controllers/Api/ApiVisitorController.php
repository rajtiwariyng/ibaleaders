<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiVisitorController extends Controller
{
    public function store(Request $request)
    {
        try {
            //dd($request->first_name);
            // Validate the incoming request using Validator facade
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
                'mobile_number' => 'required|string|max:15',
                'company_name' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'address' => 'nullable|string',
                'state_country_province' => 'nullable|string|max:255',
                'post_code' => 'nullable|string|max:20',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error.',
                    'errors' => $validator->errors(),
                ], 422); // HTTP 422 Unprocessable Entity
            }

            // Create the visitor
            $visitor = Visitor::create([
                'user_id' => $request->user_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'company_name' => $request->company_name,
                'city' => $request->city,
                'address' => $request->address,
                'state_country_province' => $request->state_country_province,
                'post_code' => $request->post_code,
            ]);

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Visitor registered successfully!',
                'data' => $visitor,
            ], 201); // HTTP 201 Created
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500); // HTTP 500 Internal Server Error
        }
    }

    public function getVideos()
    {

        $videos = Video::select('id', 'title', 'description', 'video_url', 'status', 'created_at')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Videos fetched successfully',
            'data' => $videos,
        ]);
    }

}
