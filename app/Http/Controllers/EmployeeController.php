<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class EmployeeController extends Controller
{
    public function Add($id)
    {  $teams = DB::table('teammss')
   
            ->select('teammss.*')
        ->get(); // ✅ returns a single stdClass object
        $departments = DB::table('departments')
       
        ->select('departments.*')
        ->get(); // ✅ returns a single stdClass object
        $tiltes = DB::table('tilte')
        ->select('tilte.*')
        ->get(); // ✅ returns a single stdClass object
        
        return view('add', [
         
        'departments'=>$departments,
    'teams'=>$teams,
        'id'=>$id,
'tiltes'=>$tiltes]);
    }

    public function edit($userid,$id)
    {  
        $id=$id;
        $teams = DB::table('teammss')
   
            ->select('teammss.*')
        ->get(); // ✅ returns a single stdClass object
        $departments = DB::table('departments')
       
        ->select('departments.*')
        ->get(); // ✅ returns a single stdClass object
        $tiltes = DB::table('tilte')
        ->select('tilte.*')
        ->get(); // ✅ returns a single stdClass object
        $employee = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
        ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
        ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id') // هذا ليس جدول جديد، بل alias
        ->where('users.id', $userid)
        ->select(
            'users.*',
            'teammss.*',
            'departments.*',
            'tilte.*',
         'users.email as Email',
            'tilte.Name as title',
            'users.name as Employee',
            'departments.Names as Department',
            'manager.name as DirectManagerName' // اسم المدير من نفس جدول users
        )
        ->first();
        return view('edituser', [
            'employee' => $employee,
        'departments'=>$departments,
    'teams'=>$teams,
    'id'=>$id,
'tiltes'=>$tiltes]);
    }
    
  public function update(Request $request, $id)
{$userid=$request->input('Employeeid');
 
   
    // Use Eloquent to retrieve the user
    $employee = \App\Models\User::findOrFail($userid);

    // Update only the needed fields
    $employee->name = $request->Employeename;
    $employee->email = $request->Employeeemail;

    $employee->name = $request->Employeename;
    $employee->email = $request->Employeeemail;

    if ($request->filled('Employeepassword')) {
        $employee->password = bcrypt($request->Employeepassword);
    }

    if ($request->departments && $request->departments !== "None") {
        $employee->departments_id = $request->departments;
    }

    if ($request->teams && $request->teams !== "None") {
        $employee->current_team_id = $request->teams;
    }

    if ($request->tiltes && $request->tiltes !== "None") {
        $employee->tilte_id = $request->tiltes;
    }

    $employee->save();

    return redirect()->route('show.showUSERS', $id)->with('success', 'تم تحديث البيانات بنجاح');
}
public function store(Request $request)
    {
        // التحقق من صحة البيانات
  
        // إنشاء مستخدم جديد
        User::create([
            'id' => $request->Employeeid,
            'name' => $request->Employeename,
            'email' => $request->Employeeemail,
            'tilte_id'=>$request->tiltes,
            'departments_id'=>$request->departments,
            'current_team_id'=>$request->teams,
            'password' => bcrypt($request->password), // تشفير الباسورد
        ]);

        return redirect()->back()->with('success', 'تم إضافة المستخدم بنجاح');
    }
}
