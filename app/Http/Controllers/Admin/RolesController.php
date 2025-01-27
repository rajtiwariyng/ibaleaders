<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class RolesController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(10);
        $roles = Role::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.roles.index',compact('permissions','roles'));
    }
    
    public function create()
    {   
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('admin.roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),
        [
            'name' => 'required|unique:roles|min:3'
        ]);

       if ($validator->passes())  {
          $role = Role::create(['guard_name' => 'admin', 'name' => $request->name]);
          if (!empty($request->permission)) {
            foreach ($request->permission as $name) {
              $role->givePermissionTo($name);  
            }
          }
          return redirect()->route('admin.roles.index')->with('success', 'Role added successfully');
       }  else   {
         return redirect()->route('admin.roles.create')->withInput()->withErrors($validator);
       }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('admin.roles.edit',compact('permissions','hasPermissions','role'));
    }

    public function update($id, Request $request)
    {   
        $role = Role::findOrFail($id);
        //dd($request->all());
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|min:3|unique:roles,name,'.$id.'id'
        ]);

       if ($validator->passes())  {
          $role->name = $request->name;
          $role->save();

          if (!empty($request->permission)) {
            $role->syncPermissions($request->permission);
          }
          else{
            $role->syncPermissions([]);
          }
          return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully');
       }  else   {
         return redirect()->route('admin.roles.edit',$id)->withInput()->withErrors($validator);
       }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $role = Role::find($id);

        if ($role == null) {
            return redirect()->route('admin.roles.index')->withInput()->withErrors($validator);
        }

        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Roles deleted successfully');
    }
}
