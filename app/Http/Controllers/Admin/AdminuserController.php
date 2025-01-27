<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class AdminuserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::role(['admin', 'superadmin','Data Entry Operator','Customer Support Teams'],'admin')->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.users.adminusers', compact('users'));
    }

    public function create()
    {
       $roles = Role::where('guard_name', 'admin')
             //->whereIn('name', ['admin', 'superadmin', 'Data Entry Operator', 'Customer Support Teams']) // Filter by role names
             ->paginate(50);
        return view('admin.users.create', compact('roles'));
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

        $role = Role::where('name', $request->role)
                    ->where('guard_name', 'admin')
                    ->firstOrFail();

        // Sync the role with the user, using the 'admin' guard
        $user->syncRoles([$role]);

        return redirect()->route('admin.adminUsers.list')->with('success', 'Admin User created successfully.');
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
        return view('admin.users.edit-adminusers', compact('user', 'roles'));
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

        // Assign the selected role

        // Fetch the role with the guard 'admin'
        $role = Role::where('name', $request->role)
                    ->where('guard_name', 'admin')
                    ->firstOrFail();

        // Sync the role with the user, using the 'admin' guard
        $user->syncRoles([$role]);

        return redirect()->route('admin.adminUsers.list')->with('success', 'Admin User created successfully.');
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

        return redirect()->back()->with('success', 'Admin User status updated successfully.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Soft delete the user
        $user->delete();

        return redirect()->back()->with('success', 'Admin User deleted successfully.');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        // Restore the user
        $user->restore();

        return redirect()->route('admin.users.index')->with('success', 'Admin User restored successfully.');
    }

}
