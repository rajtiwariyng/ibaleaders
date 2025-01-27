<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.permissions.index',compact('permissions'));
    }
    
    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),
        [
            'name' => 'required|unique:permissions|min:3'
        ]);

       if ($validator->passes())  {

          Permission::create(['guard_name' => 'admin', 'name' => $request->name]);
          return redirect()->route('admin.permissions.index')->with('success', 'Permission added successfully');
       }  else   {
         return redirect()->route('admin.permissions.create')->withInput()->withErrors($validator);
       }
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit',compact('permission'));
    }

    public function update($id, Request $request)
    {   

        $permission = Permission::findOrFail($id);
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|min:3|unique:permissions,name,'.$id.'id'
        ]);

       if ($validator->passes())  {

          $permission->name = $request->name;
          $permission->save();
          return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully');
       }  else   {
         return redirect()->route('admin.permissions.edit',$id)->withInput()->withErrors($validator);
       }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $permission = Permission::find($id);

        if ($permission == null) {
            return redirect()->route('admin.permissions.index')->withInput()->withErrors($validator);
        }

        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully');
    }
}
