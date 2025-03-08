<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    
     public function reportImport(){
        $user = auth()->user();
        return view('admin.users.reportimport', compact('user'));
    }
    public function reportImportPost(Request $request){
        $request->validate([
            'excel_file' => 'required'
        ]);
        
        $file = $request->file('excel_file');

        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        
        $filePath = $file->getPathname();
        $handle = fopen($filePath, "r");
    
        $header = fgetcsv($handle); // Read header row (if exists)
        // echo count(fgetcsv($handle, 3, ","));
        // exit;
        $maxLength = filesize($filePath) ?: 1000;
        
        $data = [];
        while (($row = fgetcsv($handle, $maxLength, ",")) !== false) {
            // ?echo $row[0];
            $data[] = [
                'leader_name' => $row[0],  // Column A
                'category' => $row[1], // Column B
                'company_name' => $row[2], // Column C
                'lvp_score' => $row[3],
                'rg' => $row[4],
                'rr' => $row[5],
                'v' => $row[6],
                'gbr' => $row[7],
                'bg' => $row[8],
                'start_date' => $row[9],
                'user_id'=>1
            ];
        }
    
        fclose($handle);
        
        // print_r($data);
        // exit;
        DB::table('alliance_roster_reports')->insert($data); 
        // exit;
        return back()->with('success', 'Data imported successfully!');

    }
    public function reportImportPost2(Request $request){
        $request->validate([
            'excel_file2' => 'required'
        ]);        
        $file = $request->file('excel_file2');
        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }        
        $filePath = $file->getPathname();
        $handle = fopen($filePath, "r");
        $header = fgetcsv($handle); // Read header row (if exists)
        $maxLength = filesize($filePath) ?: 1000;
        $data = [];
        while (($row = fgetcsv($handle, $maxLength, ",")) !== false) {
           $data[] = [
                'leader_name' => $row[0],  // Column A
                'p' => $row[1], // Column B
                'a' => $row[2], // Column C
                'l' => $row[3],
                'm' => $row[4],
                's' => $row[5],
                'rg' => $row[6],
                'rr' => $row[7],
                'bg' => $row[8],
                'gbr' => $row[9],
                'v' => $row[10],
                'dm' => $row[11],
                'events' => $row[12],
                't' => $row[13],
                'start_date' => $row[14],
                'user_id'=>1
            ];
        }    
        fclose($handle);
        DB::table('leadership_reports')->insert($data); 
        return back()->with('success', 'Data imported successfully!');
    }
    public function reportImportPost3(Request $request){
        $request->validate([
            'excel_file3' => 'required'
        ]);        
        $file = $request->file('excel_file3');
        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }        
        $filePath = $file->getPathname();
        $handle = fopen($filePath, "r");
        $header = fgetcsv($handle); // Read header row (if exists)
        $maxLength = filesize($filePath) ?: 1000;
        $data = [];
        while (($row = fgetcsv($handle, $maxLength, ",")) !== false) {
           $data[] = [
                'leader_name' => $row[0],  // Column A
                'date_of_event' => $row[1], // Column B
                'event_name' => $row[2], // Column C
                'email_id' => $row[3],
                'start_date' => $row[4],
                'user_id'=>1
            ];
        }    
        fclose($handle);
        DB::table('event_reports')->insert($data); 
        return back()->with('success', 'Data imported successfully!');
    }
    
    public function reportImportPost4(Request $request){
        $request->validate([
            'excel_file4' => 'required'
        ]);        
        $file = $request->file('excel_file4');
        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }        
        $filePath = $file->getPathname();
        $handle = fopen($filePath, "r");
        $header = fgetcsv($handle); // Read header row (if exists)
        $maxLength = filesize($filePath) ?: 1000;
        $data = [];
        while (($row = fgetcsv($handle, $maxLength, ",")) !== false) {
           $data[] = [
                'leader_name' => $row[0],  // Column A
                'category' => $row[1], // Column B
                'role' => $row[2], // Column C
                'membership_status' => $row[3],
                'renewal_date' => $row[4],
                'start_date' => $row[5],
                'user_id'=>1
            ];
        }    
        fclose($handle);
        DB::table('leadership_dues_reports')->insert($data); 
        return back()->with('success', 'Data imported successfully!');
    }
    public function reportImportPost5(Request $request){
        $request->validate([
            'excel_file5' => 'required'
        ]);        
        $file = $request->file('excel_file5');
        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }        
        $filePath = $file->getPathname();
        $handle = fopen($filePath, "r");
        $header = fgetcsv($handle); // Read header row (if exists)
        $maxLength = filesize($filePath) ?: 1000;
        $data = [];
        while (($row = fgetcsv($handle, $maxLength, ",")) !== false) {
           $data[] = [
                'category' => $row[0], // Column B
                'start_date' => $row[1],
                'user_id'=>1
            ];
        }    
        fclose($handle);
        DB::table('vacant_categories')->insert($data); 
        return back()->with('success', 'Data imported successfully!');
    }
    public function reportImportPost6(Request $request){
        $request->validate([
            'excel_file6' => 'required'
        ]);        
        $file = $request->file('excel_file6');
        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }        
        $filePath = $file->getPathname();
        $handle = fopen($filePath, "r");
        $header = fgetcsv($handle); // Read header row (if exists)
        $maxLength = filesize($filePath) ?: 1000;
        $data = [];
        while (($row = fgetcsv($handle, $maxLength, ",")) !== false) {
           $data[] = [
                'sponsor_leader_name' => $row[0], // Column B
                'total_leaders_created' => $row[1], 
                'new_leader_name' => $row[2], 
                'alliance_name' => $row[3], 
                'application_date' => $row[4], 
                'start_date' => $row[5],
                'user_id'=>1
            ];
        }    
        fclose($handle);
        DB::table('sponsor_reports')->insert($data); 
        return back()->with('success', 'Data imported successfully!');
    }
    public function reportImportPost7(Request $request){
        $request->validate([
            'excel_file7' => 'required'
        ]);        
        $file = $request->file('excel_file7');
        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }        
        $filePath = $file->getPathname();
        $handle = fopen($filePath, "r");
        $header = fgetcsv($handle); // Read header row (if exists)
        $maxLength = filesize($filePath) ?: 1000;
        $data = [];
        while (($row = fgetcsv($handle, $maxLength, ",")) !== false) {
           $data[] = [
                'leader_name' => $row[0], // Column B
                'renewal_date' => $row[1], 
                'rg' => $row[2], 
                'rr' => $row[3], 
                'bg' => $row[4], 
                'gbr' => $row[5], 
                'v' => $row[6], 
                'dm' => $row[7], 
                't' => $row[8], 
                'start_date' => $row[9],
                'user_id'=>1
            ];
        }    
        fclose($handle);
        DB::table('vp_reports')->insert($data); 
        return back()->with('success', 'Data imported successfully!');
    }
    public function reportImportPost8(Request $request){
        $request->validate([
            'excel_file8' => 'required'
        ]);        
        $file = $request->file('excel_file8');
        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }        
        $filePath = $file->getPathname();
        $handle = fopen($filePath, "r");
        $header = fgetcsv($handle); // Read header row (if exists)
        $maxLength = filesize($filePath) ?: 1000;
        $data = [];
        while (($row = fgetcsv($handle, $maxLength, ",")) !== false) {
           $data[] = [
                'visitor_name' => $row[0], // Column B
                'company_name' => $row[1], 
                'category' => $row[2], 
                'visit_date' => $row[3], 
                'invited_by' => $row[4], 
                'start_date' => $row[5],
                'user_id'=>1
            ];
        }    
        fclose($handle);
        DB::table('visitor_reports')->insert($data); 
        return back()->with('success', 'Data imported successfully!');
    }
    public function reportImportPost9(Request $request){
        $request->validate([
            'excel_file9' => 'required'
        ]);        
        $file = $request->file('excel_file9');
        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }        
        $filePath = $file->getPathname();
        $handle = fopen($filePath, "r");
        $header = fgetcsv($handle); // Read header row (if exists)
        $maxLength = filesize($filePath) ?: 1000;
        $data = [];
        while (($row = fgetcsv($handle, $maxLength, ",")) !== false) {
           $data[] = [
                'company_name' => $row[0], // Column B
                'category' => $row[1], 
                'avg_referrals' => $row[2], 
                'avg_visitors' => $row[3], 
                'business_given' => $row[4], 
                'absenteeism' => $row[5], 
                'events_attended' => $row[6], 
                'testimonial' => $row[7], 
                'late' => $row[8], 
                'lvp_score' => $row[9], 
                'start_date' => $row[10],
                'user_id'=>1
            ];
        }    
        fclose($handle);
        DB::table('leadership_victory_programs')->insert($data); 
        return back()->with('success', 'Data imported successfully!');
    }
    public function reportImportPost10(Request $request){
        $request->validate([
            'excel_file10' => 'required'
        ]);        
        $file = $request->file('excel_file10');
        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }        
        $filePath = $file->getPathname();
        $handle = fopen($filePath, "r");
        $header = fgetcsv($handle); // Read header row (if exists)
        $maxLength = filesize($filePath) ?: 1000;
        $data = [];
        while (($row = fgetcsv($handle, $maxLength, ",")) !== false) {
           $data[] = [
                'meeting_date' => $row[0], // Column B
                'knowledge_partner_name' => $row[1], 
                'meeting_agenda' => $row[2],
                'start_date' => $row[3],
                'user_id'=>1
            ];
        }    
        fclose($handle);
        DB::table('knowledge_partner_reports')->insert($data); 
        return back()->with('success', 'Data imported successfully!');
    }

}
