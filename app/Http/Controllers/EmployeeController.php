<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class EmployeeController extends Controller
{
    public function Add()
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
'tiltes'=>$tiltes]);
    }

    public function edit($id)
    {  $teams = DB::table('teammss')
   
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
        ->where('users.id', $id)
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
'tiltes'=>$tiltes]);
    }
    
    public function update(Request $request, $id)
    {
        $employee = DB::table('users')::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            // أضف التحققات الأخرى حسب الحاجة
        ]);
    
        $employee->update($request->all());
    
        return redirect()->route('employees.edit', $id)->with('success', 'تم تحديث البيانات بنجاح');
    }
}
