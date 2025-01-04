<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:visitors,email',
            'mobile_number' => 'required|string|max:15',
            'company_name' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'state_country_province' => 'nullable|string|max:255',
            'post_code' => 'nullable|string|max:20',
        ]);

        Visitor::create([
            'user_id' => auth()->id(), // Logged-in user's ID
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

        return response()->json(['success' => 'Visitor registered successfully!']);
    }

    public function visitors()
    {
        $visitors = Visitor::orderBy('created_at', 'desc')->get(); // Fetch all visitors
        return view('admin.users.visitors', compact('visitors')); // Pass to a view
    }
}
