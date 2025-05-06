<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function showRegister()
  {
      return view('auth.register');
  }public function searches(Request $request)

  {
    
    $selectemployee=$request->input('Employeeid');
   
       if($request->input('Employeeid')!='')
       {    $users = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
        ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
        ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id') // هذا ليس جدول جديد، بل alias
        ->where('users.id', $selectemployee)
        ->select(
            'users.*',
            'teammss.*',
            'departments.*',
            'tilte.*',
            'tilte.Name as title',
            'users.name as Employee',
            'departments.Names as Department',
            'manager.name as DirectManagerName' // اسم المدير من نفس جدول users
        )
        ->get();
          $userdepartments =  DB::table('users')
          ->join('departments', 'users.departments_id', '=', 'departments.ID')
          ->where('users.id', $selectemployee)
          ->select('users.departments_id','departments.*')
          ->get(); // ✅ returns a single stdClass object
  
      $userdepartments = DB::table('users')
      ->join('departments', 'users.departments_id', '=', 'departments.ID')
      ->where('users.id', $selectemployee)
      ->select('users.departments_id','departments.*')
      ->get(); // ✅ returns a single stdClass object
  
  
      
    
      
      $teams = DB::table('teammss')
      ->join('users', 'users.current_team_id', '=', 'teammss.team_id')
      ->where('users.id', $selectemployee)
      ->select('teammss.*')
  ->get(); // ✅ returns a single stdClass object
  
  $Allusers=DB::table('users')
  ->join('departments', 'users.departments_id', '=', 'departments.ID')
  
  ->select('users.*','departments.*')
  ->get();
  
  


       }

       $selectname=$request->input('Employeename');
       if($selectname!= '') {

        // استعلام بيانات الموظف مع معلومات القسم والوظيفة والفريق والمدير
        $users = DB::table('users')
            ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
            ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
            ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id')
            ->where('users.name', 'like', '%' . $selectname . '%')
            ->select(
                'users.*',
                'teammss.*',
                'departments.*',
                'tilte.*',
                'tilte.Name as title',
                'users.name as Employee',
                'departments.Names as Department',
                'manager.name as DirectManagerName'
            )
            ->get();
    
        // بيانات القسم الخاص بالموظف
        $userdepartments = DB::table('users')
            ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->where('users.name', 'like', '%' . $selectname . '%')
            ->select('users.departments_id', 'departments.*')
            ->get();
    
        // بيانات الفريق الخاص بالموظف
        $teams = DB::table('teammss')
            ->join('users', 'users.current_team_id', '=', 'teammss.team_id')
            ->where('users.name', 'like', '%' . $selectname . '%')
            ->select('teammss.*')
            ->get();
    
        // جميع الموظفين لجميع الأقسام
        $Allusers = DB::table('users')
            ->join('departments', 'users.departments_id', '=', 'departments.ID')
            
            ->select('users.*', 'departments.*')
            ->get();
    }
       
       else{
    $userdepartments = DB::table('departments')
  
    ->select('departments.*')
    ->get(); // ✅ returns a single stdClass object
    $users = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
    ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
    ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id') // هذا ليس جدول جديد، بل alias
    ->select(
        'users.*',
        'teammss.*',
        'departments.*',
        'tilte.*',
        'tilte.Name as title',
        'users.name as Employee',
        'departments.Names as Department',
        'manager.name as DirectManagerName' // اسم المدير من نفس جدول users
    )
    ->get();
    $teams = DB::table('teammss')
    
        ->select('teammss.*')
    ->get(); // ✅ returns a single stdClass object
    $Allusers=DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        
        ->select('users.*','departments.*')
        ->get();
      $selectedTeam = $request->input('teams');
      $selecteduser = $request->input('usersids');
      $selecteddepartment=$request->input('deparments');
      if ($selecteduser && $selecteduser !== 'All'){
        $users = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
        ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
        ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id') // هذا ليس جدول جديد، بل alias
        ->where('users.id', $selecteduser)
        ->select(
            'users.*',
            'teammss.*',
            'departments.*',
            'tilte.*',
            'tilte.Name as title',
            'users.name as Employee',
            'departments.Names as Department',
            'manager.name as DirectManagerName' // اسم المدير من نفس جدول users
        )
        ->get();
          $userdepartments =  DB::table('users')
          ->join('departments', 'users.departments_id', '=', 'departments.ID')
          ->where('users.id', $selecteduser)
          ->select('users.departments_id','departments.*')
          ->get(); // ✅ returns a single stdClass object
  
      $userdepartments = DB::table('users')
      ->join('departments', 'users.departments_id', '=', 'departments.ID')
      ->where('users.id', $selecteduser)
      ->select('users.departments_id','departments.*')
      ->get(); // ✅ returns a single stdClass object
  
  
      
    
      
      $teams = DB::table('teammss')
      ->join('users', 'users.current_team_id', '=', 'teammss.team_id')
      ->where('users.id', $selecteduser)
      ->select('teammss.*')
  ->get(); // ✅ returns a single stdClass object
  
     
  
  
  
  
  
      }
      
      else{ if ($selectedTeam && $selectedTeam !== 'All')
          {
            $teams = DB::table('teammss')
            ->join('users', 'users.current_team_id', '=', 'teammss.team_id')
            ->where('users.current_team_id', $selectedTeam)
            ->select('teammss.*')
        ->get(); // ✅ returns a single stdClass object
        
           
            $users = DB::table('users')
            ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
            ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
            ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id') // هذا ليس جدول جديد، بل alias
            ->where('users.current_team_id', $selectedTeam)
            ->select(
                'users.*',
                'teammss.*',
                'departments.*',
                'tilte.*',
                'tilte.Name as title',
                'users.name as Employee',
                'departments.Names as Department',
                'manager.name as DirectManagerName' // اسم المدير من نفس جدول users
            )
            ->get();
              $Allusers = DB::table('users')
              ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
              ->where('users.current_team_id', $selectedTeam)
              ->select('users.*', 'teammss.*')
              ->get();
              $userdepartments = DB::table('users')
              ->join('departments', 'users.departments_id', '=', 'departments.ID')
              ->where('users.current_team_id', $selectedTeam)
              ->select('users.departments_id','departments.*')
              ->get(); // ✅ returns a single stdClass object
         
      
      
      }
      else{
  
        $userdepartments = DB::table('departments')
        ->where('departments.ID', $selecteddepartment)
        ->select('departments.*')
        ->get(); // ✅ returns a single stdClass object
        $users = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
        ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
        ->where('departments.ID', $selecteddepartment)
        ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id') // هذا ليس جدول جديد، بل alias
        ->select(
            'users.*',
            'teammss.*',
            'departments.*',
            'tilte.*',
            'tilte.Name as title',
            'users.name as Employee',
            'departments.Names as Department',
            'manager.name as DirectManagerName' // اسم المدير من نفس جدول users
        )
        ->get();
        $teams = DB::table('teammss')
        ->join('departments', 'teammss.depart_id', '=', 'departments.ID')
        ->where('departments.ID', $selecteddepartment)
            ->select('teammss.*')
        ->get(); // ✅ returns a single stdClass object
        $Allusers=DB::table('users')
            ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->where('departments.ID', $selecteddepartment)
            ->select('users.*','departments.*')
            ->get();
  
      
  
  
  }
}
      }
    
  
      return view('updateinfo', [
        'users' => $users,
      'userdepartments'=>$userdepartments,
    'teams'=>$teams,
  'Allusers'=>$Allusers]);
      
      
  }





  public function searcch(Request $request)
  {
    $userdepartments = DB::table('departments')
  
    ->select('departments.*')
    ->get(); // ✅ returns a single stdClass object
    $users = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
    ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
    ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id') // هذا ليس جدول جديد، بل alias
    ->select(
        'users.*',
        'teammss.*',
        'departments.*',
        'tilte.*',
        'tilte.Name as title',
        'users.name as Employee',
        'departments.Names as Department',
        'manager.name as DirectManagerName' // اسم المدير من نفس جدول users
    )
    ->get();
    $teams = DB::table('teammss')
    
        ->select('teammss.*')
    ->get(); // ✅ returns a single stdClass object
    $Allusers=DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        
        ->select('users.*','departments.*')
        ->get();
   
    $selectedTeam = $request->input('teams');
    $selecteduser = $request->input('usersids');
    $selecteddepartment=$request->input('department');
    if ($selecteduser && $selecteduser !== 'All'){
      $userdepartments = DB::table('departments')
      ->join('users', 'users.departments_id', '=', 'departments.ID')
      ->where('users.id', $selecteduser)
    ->select('departments.*')
    ->get(); // ✅ returns a single stdClass object
   
      $teams = DB::table('teammss')
      ->join('users', 'users.current_team_id', '=', 'teammss.team_id')
      ->where('users.id', $selecteduser)
      ->select('teammss.*')
  ->get(); // ✅ returns a single stdClass object
        $userdepartments =  DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.id', $selecteduser)
        ->select('users.departments_id','departments.*')
        ->get(); // ✅ returns a single stdClass object
$users = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
    ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
    ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id') // هذا ليس جدول جديد، بل alias
    ->where('users.id', $selecteduser)
    ->select(
        'users.*',
        'teammss.*',
        'departments.*',
        'tilte.*',
        'tilte.Name as title',
        'users.name as Employee',
        'departments.Names as Department',
        'manager.name as DirectManagerName' // اسم المدير من نفس جدول users
    )
    ->get();



  
 



    }
    
    else{ if ($selectedTeam && $selectedTeam !== 'All')
        {

          $userdepartments = DB::table('departments')
      
          ->where('departments.ID', $selectedTeam)
        ->select('departments.*')
        ->get(); // ✅ returns a single stdClass object
       
          $teams = DB::table('teammss')
          ->join('departments', 'departments.ID', '=', 'teammss.depart_id')
          ->where('departments.ID', $selectedTeam)
          ->select('teammss.*')
      ->get(); // ✅ returns a single stdClass object
            $userdepartments =  DB::table('users')
            ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->where('departments.ID', $selectedTeam)

            ->select('users.departments_id','departments.*')
            ->get(); // ✅ returns a single stdClass object
    $users = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
        ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
        ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id') // هذا ليس جدول جديد، بل alias
        ->where('departments.ID', $selectedTeam)

        ->select(
            'users.*',
            'teammss.*',
            'departments.*',
            'tilte.*',
            'tilte.Name as title',
            'users.name as Employee',
            'departments.Names as Department',
            'manager.name as DirectManagerName' // اسم المدير من نفس جدول users
        )
        ->get();
    
    
    
      
    }
  

    return view('updateinfo', [
      'users' => $users,
    'userdepartments'=>$userdepartments,
  'teams'=>$teams,
'Allusers'=>$Allusers]);
    }
    
     
  }

  public function showUSERS()
  {
    $userdepartments = DB::table('departments')
  
    ->select('departments.*')
    ->get(); // ✅ returns a single stdClass object
    $users = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
    ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
    ->leftJoin('users as manager', 'users.DirectManagerID', '=', 'manager.id') // هذا ليس جدول جديد، بل alias
    ->select(
        'users.*',
        'teammss.*',
        'departments.*',
        'tilte.*',
        'tilte.Name as title',
        'users.name as Employee',
        'departments.Names as Department',
        'manager.name as DirectManagerName' // اسم المدير من نفس جدول users
    )
    ->get();
    $teams = DB::table('teammss')
        ->select('teammss.*')
    ->get(); // ✅ returns a single stdClass object
    $Allusers=DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('users.*','users.name as name','departments.*')
        ->get();
      return view('updateinfo', [
        'users' => $users,
      'userdepartments'=>$userdepartments,
    'teams'=>$teams,
  'Allusers'=>$Allusers]);
  }


  public function showLogin()
  {
      return view('auth.login');
  }

  public function register(Request $request)
  {
      $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
      ]);

      $user = User::create($validated);

      Auth::login($user);

      return redirect()->route('/');
  }

  public function login(Request $request)
  {
      $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
      ]);
      $users = DB::table('users')
      ->select('users.*')
      ->where('email',$request['email'])
      ->get();
    
      $user = User::where('email', $request['email'])->first();
      if (Auth::attempt($validated)) {
        $request->session()->regenerate();

        return redirect()->route('user',['userid' => $user]
    );
      }

      throw ValidationException::withMessages([
        'credentials' => 'Sorry, incorrect credentials',
      ]);
  }

  public function logout(Request $request)
  {
      Auth::logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect()->route('show.login');
  }
}
