<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::role('user', 'web')->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['user'])
             ->paginate(10);
        return view('admin.users.create-front-user', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'nullable|string|max:15',
            'industry' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'industry' => $request->industry,
            'password' => Hash::make($request->password),
        ]);

        // Assign the selected role
        $user->assignRole('user');

        return redirect()->route('admin.frontedUsers.list')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        if (!Auth::guard('admin')->check() || !Auth::guard('admin')->user()->hasRole(['admin', 'superadmin'])) {
            abort(403, 'Unauthorized action.');
        }

        // Prevent editing if the user to be edited has the 'superadmin' role
        if ($user->hasRole('superadmin')) {
            abort(403, 'You cannot edit a user with the Superadmin role.');
        }

        $roles = Role::all();
        return view('admin.users.edit-frontusers', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile_number' => 'nullable|string|max:15',
            'industry' => 'nullable|string|max:255',
            'role' => 'required|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'industry' => $request->industry,
        ]);
        //dd($request->all());

        // Assign the selected role
        //$user->syncRoles([$request->role]);

        return redirect()->route('admin.frontedUsers.list')->with('success', 'User created successfully.');
    }

    public function changeStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate status input
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        // Update status
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Soft delete the user
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        // Restore the user
        $user->restore();

        return redirect()->route('admin.users.index')->with('success', 'User restored successfully.');
    }

}
