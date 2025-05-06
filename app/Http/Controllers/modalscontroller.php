<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class modalscontroller extends Controller
{public function index(): View
    {
        return view('auth.login');
    }  



    function users($userid){
       
        $id=$userid;
        $userdepartment = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.id', $userid)
        ->select('users.departments_id','departments.*')
        ->first(); // ✅ returns a single stdClass object
        if(($userdepartment->departments_id)==7||($userdepartment->departments_id)==10){
            $employees = DB::table('users')
    ->leftJoin('compensations', 'users.id', '=', 'compensations.Updated_By')
    ->leftJoin('vali', 'vali.Order_ID', '=', 'compensations.Order_ID')
    
    ->select(
        'users.id',
        'users.name',
        'users.email',
        DB::raw('COUNT(compensations.Order_ID ) as compensations_count'),
        DB::raw('COUNT(CASE WHEN vali.validation = 0 THEN 1 END) as validation_wrong'),
        DB::raw('COUNT(CASE WHEN vali.validation = 1 THEN 1 END) as validation_right')
    )
    ->groupBy(
        'users.id',
        'users.name',
        'users.email'
    )
    ->get();
            $deparments = DB::table('departments')  
        ->select('departments.*')
        ->get(); // ✅ returns a single stdClass object
        $usertitle = DB::table('users')
        ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
        ->where('users.id', $userid)
        ->select('users.*', 'tilte.*')
        ->first();
        $users = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
        ->where('users.id',$userid)
        ->select('users.*','departments.*','tilte.*')
        ->first();


    $Allusers=DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.departments_id', $userdepartment->departments_id)
        ->select('users.*','departments.*')
        ->get();
    $userdepartments = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->where('users.id', $userid)
    ->select('users.departments_id','departments.*')
    ->get(); // ✅ returns a single stdClass object
    $teams = DB::table('teammss')
    ->join('departments', 'teammss.depart_id', '=', 'departments.ID')
    ->select('teammss.*','departments.*')
    ->get(); // ✅ returns a single stdClass object

    
        $totalaction = DB::table('compensations')
        ->join('users', 'users.id', '=', 'compensations.Updated_By')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->select('compensations.*','users.*','departments.*')

            ->count();

            $compensation = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
      
    ->where('validation',0)
    ->select('compensations.*','users.*', 'vali.*')
    ->get();
    $reasons = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->select('compensations.*','users.name as Employee','departments.*')
  
    ->where('vali.reasonid',0)
    ->select('compensations.*','users.name as Employee', 'vali.*')
    ->get();
    $wrongactionscount = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
      
    ->where('validation',0)
    ->select('compensations.*', 'vali.*')
    ->count();
    $rightactionscount = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
      
    ->where('validation',1)
    ->select('compensations.*', 'vali.*')
    ->count();
    $wrongreasoncount = DB::table('compensations')
     ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
      
    ->where('validation',0)
    ->select('compensations.*', 'vali.*')
    ->count();
        return view('admin', [
            'users' => $users,
            'employees' => $employees,
            'userdepartments' =>  $userdepartments ,
            'department'=>$deparments,
            'totalaction'=> $totalaction,
            'rightactionscount'=> $rightactionscount,
            'wrongactionscount'=> $wrongactionscount,
            'wrongreasoncount'=> $wrongreasoncount,
            'compensations' => $compensation,
            'reasons' => $reasons,
            'teams' => $teams,
            'Allusers' => $Allusers,
            'id'=>$id
        ]);
        }
        else{
        $userdepartmentt = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.id', $userid)
        ->select('users.departments_id','departments.*')
        ->get(); // ✅ returns a single stdClass object
        $usertitle = DB::table('users')
        ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
        ->where('users.id', $userid)
        ->select('users.*', 'tilte.*')
        ->first();
        $users = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
        ->where('users.id',$userid)
        ->select('users.*','departments.*','tilte.*')
        ->first();

if($usertitle->tilte_id=='6')
{$employees = DB::table('users')
    ->leftJoin('compensations', 'users.id', '=', 'compensations.Updated_By')
    ->leftJoin('vali', 'vali.Order_ID', '=', 'compensations.Order_ID')
    ->where('users.id', $userid)
    ->select(
        'users.id',
        'users.name',
        'users.email',
        DB::raw('COUNT(compensations.Order_ID ) as compensations_count'),
        DB::raw('COUNT(CASE WHEN vali.validation = 0 THEN 1 END) as validation_wrong'),
        DB::raw('COUNT(CASE WHEN vali.validation = 1 THEN 1 END) as validation_right')
    )
    ->groupBy(
        'users.id',
        'users.name',
        'users.email'
    )
    ->get();
    $teams = DB::table('users')
    ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
    ->where('users.id', $userid)
    ->select('teammss.*', 'users.*')
    ->get(); // ✅ returns a single stdClass object
    $userdepartments =$userdepartmentt;
    
    $users = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
    ->where('users.id',$userid)
    ->select('users.*','departments.*','tilte.*')
    ->first();
    $userss = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
    ->where('users.id',$userid)
    ->select('users.*','departments.*','tilte.*')
    ->get();
$Allusers=$userss;
 $totalaction = DB::table('compensations')
        ->select('compensations.*')
        ->where('Updated_By',$userid)
        ->count();

        $compensation = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
        ->join('users', 'compensations.Updated_By', '=', 'users.id')
        ->where('compensations.Updated_By', $userid)
        ->where('vali.validation', 0)
        ->select('compensations.*', 'users.name', 'vali.*')
        ->get();
        $reasons = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
        
        ->join('users', 'compensations.Updated_By', '=', 'users.id')
        ->where('compensations.Updated_By', $userid)
        ->where('vali.reasonid', 0)
        ->select('compensations.*', 'users.name as Employee', 'vali.*')
        ->get();
$wrongactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->where('Updated_By',$userid)
->where('validation',0)
->select('compensations.*', 'vali.*')
->count();
$rightactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->where('Updated_By',$userid)
->where('validation',1)
->select('compensations.*', 'vali.*')
->count();
$wrongreasoncount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->where('Updated_By',$userid)
->where('validation',0)
->select('compensations.*', 'vali.*')
->count();
  

}

else{
    $employees = DB::table('users')
    ->leftJoin('compensations', 'users.id', '=', 'compensations.Updated_By')
    ->leftJoin('vali', 'vali.Order_ID', '=', 'compensations.Order_ID')
          ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.departments_id', $userdepartment->departments_id)
    ->select(
        'users.id',
        'users.name',
        'users.email',
        DB::raw('COUNT(compensations.Order_ID ) as compensations_count'),
        DB::raw('COUNT(CASE WHEN vali.validation = 0 THEN 1 END) as validation_wrong'),
        DB::raw('COUNT(CASE WHEN vali.validation = 1 THEN 1 END) as validation_right')
    )
    ->groupBy(
        'users.id',
        'users.name',
        'users.email'
    )
    ->get();

    $Allusers=DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.departments_id', $userdepartment->departments_id)
        ->select('users.*','departments.*')
        ->get();
    $userdepartments = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->where('users.id', $userid)
    ->select('users.departments_id','departments.*')
    ->get(); // ✅ returns a single stdClass object
    $teams = DB::table('teammss')
    ->join('departments', 'teammss.depart_id', '=', 'departments.ID')
    ->where('teammss.depart_id', $userdepartment->departments_id)
    ->select('teammss.*','departments.*')
    ->get(); // ✅ returns a single stdClass object

    
        $totalaction = DB::table('compensations')
        ->join('users', 'users.id', '=', 'compensations.Updated_By')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->select('compensations.*','users.*','departments.*')
            ->where('users.departments_id',$userdepartment->departments_id)
            ->count();

            $compensation = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.departments_id',$userdepartment->departments_id)
    ->where('validation',0)
    ->select('compensations.*','users.*', 'vali.*')
    ->get();
    $reasons = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->select('compensations.*','users.*','departments.*')
    ->where('users.departments_id',$userdepartment->departments_id)
    ->where('vali.reasonid',0)
    ->select('compensations.*','users.name as Employee', 'vali.*')
    ->get();
    $wrongactionscount = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.departments_id',$userdepartment->departments_id)
    ->where('validation',0)
    ->select('compensations.*', 'vali.*')
    ->count();
    $rightactionscount = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.departments_id',$userdepartment->departments_id)
    ->where('validation',1)
    ->select('compensations.*', 'vali.*')
    ->count();
    $wrongreasoncount = DB::table('compensations')
     ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.departments_id',$userdepartment->departments_id)
    ->where('validation',0)
    ->select('compensations.*', 'vali.*')
    ->count();}
        return view('modals', [
            'users' => $users,
            'userdepartments' =>  $userdepartments ,
           
            'totalaction'=> $totalaction,
            'rightactionscount'=> $rightactionscount,
            'wrongactionscount'=> $wrongactionscount,
            'wrongreasoncount'=> $wrongreasoncount,
            'compensations' => $compensation,
            'reasons' => $reasons,
            'teams' => $teams,
            'Allusers' => $Allusers,
            'employees'=>$employees,
            'id'=>$id
        ]);}
    }
    
    

        public function search(Request $request)
{ 
  
    //team selected
    $selectedTeam = $request->input('teams');
    $userid=$request->userid;
    $userdepartment = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->where('users.id', $userid)
    ->select('users.departments_id','departments.*')
    ->first(); // ✅ returns a single stdClass object
    $userdepartmentt = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->where('users.id', $userid)
    ->select('users.departments_id','departments.*')
    ->get(); // ✅ returns a single stdClass object
    $users = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
    ->where('users.id',$userid)
    ->select('users.*','departments.*','tilte.*')
    ->first();
    $usertitle = DB::table('users')
    ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
    ->where('users.id', $userid)
    ->select('users.*', 'tilte.*')
    ->first();
    $id=$userid;

  
   
    if($usertitle->tilte_id=='6')
        {
            $employees = DB::table('users')
    ->leftJoin('compensations', 'users.id', '=', 'compensations.Updated_By')
    ->leftJoin('vali', 'vali.Order_ID', '=', 'compensations.Order_ID')
          ->where('users.id',$userid)
    ->select(
        'users.id',
        'users.name',
        'users.email',
        DB::raw('COUNT(compensations.Order_ID ) as compensations_count'),
        DB::raw('COUNT(CASE WHEN vali.validation = 0 THEN 1 END) as validation_wrong'),
        DB::raw('COUNT(CASE WHEN vali.validation = 1 THEN 1 END) as validation_right')
    )
    ->groupBy(
        'users.id',
        'users.name',
        'users.email'
    )
    ->get();
            $userdepartments =$userdepartmentt;
            $Allusers=DB::table('users')
            ->where('users.id',$userid)
            ->select('users.*')
            ->get(); //
    
    $totalaction = DB::table('compensations')
        ->select('compensations.*')
        ->where('Updated_By',$userid)
        
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
    
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
        })
        ->count();
        $teams = DB::table('teammss')
        ->join('users', 'users.current_team_id', '=', 'teammss.team_id')
        ->where('users.id',$userid)
        ->select('teammss.*','users.*')
        ->get(); // ✅ returns a single stdClass object
        $compensation = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
        ->join('users', 'compensations.Updated_By', '=', 'users.id')
        ->where('compensations.Updated_By', $userid)
        ->where('vali.validation', 0)
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
    
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
        })
        ->select('compensations.*','users.*', 'vali.*')
        ->get();

        $reasons = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
   
        ->join('users', 'compensations.Updated_By', '=', 'users.id')
        ->where('compensations.Updated_By', $userid)
        ->where('vali.reasonid', 0)
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
    
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
        })
        ->select('compensations.*','users.name as Employee', 'vali.*')
        ->get();
$wrongactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->where('Updated_By',$userid)
->where('validation',0)
->where(function ($query) use ($request) {
    if ($request->filled('orderid')) {
        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
    }

    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
        $query->orWhereBetween('compensations.UpdatedOn', [
            $request->firstcreatedon_date,
            $request->secondcreatedon_date
        ]);
    }
})
->select('compensations.*', 'vali.*')
->count();
$rightactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->where('Updated_By',$userid)
->where('validation',1)
->where(function ($query) use ($request) {
    if ($request->filled('orderid')) {
        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
    }

    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
        $query->orWhereBetween('compensations.UpdatedOn', [
            $request->firstcreatedon_date,
            $request->secondcreatedon_date
        ]);
    }
})
->select('compensations.*', 'vali.*')
->count();
$wrongreasoncount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->where('Updated_By',$userid)
->where('validation',0)
->where(function ($query) use ($request) {
    if ($request->filled('orderid')) {
        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
    }

    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
        $query->orWhereBetween('compensations.UpdatedOn', [
            $request->firstcreatedon_date,
            $request->secondcreatedon_date
        ]);
    }
})
->select('compensations.*', 'vali.*')
->count();
    
    }

    

  
    else{


        
        $selectedTeam = $request->input('teams');
        $selecteduser = $request->input('usersids');
        if ($selecteduser && $selecteduser !== 'All'){
            $employees = DB::table('users')
            ->leftJoin('compensations', 'users.id', '=', 'compensations.Updated_By')
            ->leftJoin('vali', 'vali.Order_ID', '=', 'compensations.Order_ID')
            ->where('users.id',$selecteduser)
            ->select(
                'users.id',
                'users.name',
                'users.email',
                DB::raw('COUNT(compensations.Order_ID ) as compensations_count'),
                DB::raw('COUNT(CASE WHEN vali.validation = 0 THEN 1 END) as validation_wrong'),
                DB::raw('COUNT(CASE WHEN vali.validation = 1 THEN 1 END) as validation_right')
            )
            ->groupBy(
                'users.id',
                'users.name',
                'users.email'
            )
            ->get();
         
        $Allusers=DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.departments_id', $userdepartment->departments_id)
        ->select('users.*','departments.*')
        ->get();
        $userdepartments = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.id', $userid)
        ->select('users.departments_id','departments.*')
        ->get(); // ✅ returns a single stdClass object


        $id=$userid;
      
    $totalaction = DB::table('compensations')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.departments_id',$userdepartment->departments_id)
        ->where('users.id',$selecteduser)
        ->select('compensations.*')
       
       
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
    
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
            
        })
        ->count();

        $teams = DB::table('teammss')
        ->join('departments', 'teammss.depart_id', '=', 'departments.ID')
        ->where('teammss.depart_id', $userdepartment->departments_id)
        ->select('teammss.*','departments.*')
        ->get(); // ✅ returns a single stdClass object
        $compensation = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
        ->join('users', 'users.id', '=', 'compensations.Updated_By')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->select('compensations.*','users.*','departments.*')
            ->where('users.departments_id',$userdepartment->departments_id)
            ->where('users.id',$selecteduser)
        ->where('vali.validation', 0)
       
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
    
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
        })
        ->select('compensations.*','users.*', 'vali.*')
        ->get();

        $reasons = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
        ->join('users', 'users.id', '=', 'compensations.Updated_By')
        
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->select('compensations.*','users.name as Employee','departments.*')
            ->where('users.departments_id',$userdepartment->departments_id)
            ->where('users.id',$selecteduser)
        ->where('vali.reasonid', 0)
       
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
    
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
        })
        ->select('compensations.*','users.*', 'vali.*')
        ->get();
$wrongactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->select('compensations.*','users.*','departments.*')
    ->where('users.departments_id',$userdepartment->departments_id)
    ->where('users.id',$selecteduser)
->where('validation',0)


->where(function ($query) use ($request) {
    if ($request->filled('orderid')) {
        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
    }

    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
        $query->orWhereBetween('compensations.UpdatedOn', [
            $request->firstcreatedon_date,
            $request->secondcreatedon_date
        ]);
      
    }
})
->select('compensations.*', 'vali.*')
->count();
$rightactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->select('compensations.*','users.*','departments.*')
    ->where('users.departments_id',$userdepartment->departments_id)
    ->where('users.id',$selecteduser)
->where('validation',1)

->where(function ($query) use ($request) {
    if ($request->filled('orderid')) {
        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
    }

    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
        $query->orWhereBetween('compensations.UpdatedOn', [
            $request->firstcreatedon_date,
            $request->secondcreatedon_date
        ]);
    }
})
->select('compensations.*', 'vali.*')
->count();
$wrongreasoncount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->select('compensations.*','users.*','departments.*')
    ->where('users.id',$selecteduser)
    
    ->where('users.departments_id',$userdepartment->departments_id)
    ->where('users.id',$selecteduser)
->where('validation',0)
->where(function ($query) use ($request) {
    if ($request->filled('orderid')) {
        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
    }

    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
        $query->orWhereBetween('compensations.UpdatedOn', [
            $request->firstcreatedon_date,
            $request->secondcreatedon_date
        ]);
    }
})
->select('compensations.*', 'vali.*')
->count();
    




        }
        
        else{ 
            
            if ($selectedTeam && $selectedTeam !== 'All')
            {
                $employees = DB::table('users')
                ->leftJoin('compensations', 'users.id', '=', 'compensations.Updated_By')
                ->leftJoin('vali', 'vali.Order_ID', '=', 'compensations.Order_ID')
                ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
                ->where('users.current_team_id', $selectedTeam)
                ->select(
                    'users.id',
                    'users.name',
                    'users.email',
                    DB::raw('COUNT(compensations.Order_ID ) as compensations_count'),
                    DB::raw('COUNT(CASE WHEN vali.validation = 0 THEN 1 END) as validation_wrong'),
                    DB::raw('COUNT(CASE WHEN vali.validation = 1 THEN 1 END) as validation_right')
                )
                ->groupBy(
                    'users.id',
                    'users.name',
                    'users.email'
                )
                ->get();

                $Allusers = DB::table('users')
                ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
                ->where('users.current_team_id', $selectedTeam)
                ->select('users.*', 'teammss.*')
                ->get();
            $userdepartments = DB::table('users')
            ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->where('users.id', $userid)
            ->select('users.departments_id','departments.*')
            ->get(); // ✅ returns a single stdClass object
    
    
            $id=$userid;
            $totalaction = DB::table('compensations')
            ->join('users', 'users.id', '=', 'compensations.Updated_By')
            ->join('departments', 'users.departments_id', '=', 'departments.ID')
                ->select('compensations.*','users.*','departments.*')
                ->where('users.departments_id',$userdepartment->departments_id)
                ->select('compensations.*')
               
                ->where('users.current_team_id', $request->teams)
                ->where(function ($query) use ($request) {
                    if ($request->filled('orderid')) {
                        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
                    }
            
                    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                        $query->orWhereBetween('compensations.UpdatedOn', [
                            $request->firstcreatedon_date,
                            $request->secondcreatedon_date
                        ]);
                    }
                })
                ->count();
                
                $teams = DB::table('teammss')
                ->join('departments', 'teammss.depart_id', '=', 'departments.ID')
                ->where('teammss.depart_id', $userdepartment->departments_id)
                ->select('teammss.*','departments.*')
                ->get(); // ✅ returns a single stdClass object
                $compensation = DB::table('compensations')
                ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
                ->join('users', 'users.id', '=', 'compensations.Updated_By')
                ->join('departments', 'users.departments_id', '=', 'departments.ID')
                    ->select('compensations.*','users.*','departments.*')
                    ->where('users.departments_id',$userdepartment->departments_id)
                ->where('vali.validation', 0)
                ->where('users.current_team_id', $request->teams)
                ->where(function ($query) use ($request) {
                    if ($request->filled('orderid')) {
                        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
                    }
            
                    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                        $query->orWhereBetween('compensations.UpdatedOn', [
                            $request->firstcreatedon_date,
                            $request->secondcreatedon_date
                        ]);
                    }
                })
                ->select('compensations.*','users.*', 'vali.*')
                ->get();

                $reasons = DB::table('compensations')
                ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
                ->join('users', 'users.id', '=', 'compensations.Updated_By')
              
                ->join('departments', 'users.departments_id', '=', 'departments.ID')
                    ->select('compensations.*','users.name as Employee','departments.*')
                    ->where('users.departments_id',$userdepartment->departments_id)
                ->where('vali.reasonid', 0)
                ->where('users.current_team_id', $request->teams)
                ->where(function ($query) use ($request) {
                    if ($request->filled('orderid')) {
                        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
                    }
            
                    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                        $query->orWhereBetween('compensations.UpdatedOn', [
                            $request->firstcreatedon_date,
                            $request->secondcreatedon_date
                        ]);
                    }
                })
                ->select('compensations.*','users.*', 'vali.*')
                ->get();
        $wrongactionscount = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
        ->join('users', 'users.id', '=', 'compensations.Updated_By')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->select('compensations.*','users.*','departments.*')
            ->where('users.departments_id',$userdepartment->departments_id)
        ->where('validation',0)
        
        ->where('users.current_team_id', $request->teams)
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
        
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
              
            }
        })
        ->select('compensations.*', 'vali.*')
        ->count();
        $rightactionscount = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
        ->join('users', 'users.id', '=', 'compensations.Updated_By')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->select('compensations.*','users.*','departments.*')
            ->where('users.departments_id',$userdepartment->departments_id)
        ->where('validation',1)
        ->where('users.current_team_id', $request->teams)
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
        
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
        })
        ->select('compensations.*', 'vali.*')
        ->count();
        $wrongreasoncount = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
        ->join('users', 'users.id', '=', 'compensations.Updated_By')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->select('compensations.*','users.*','departments.*')
            ->where('users.current_team_id', $request->teams)
            ->where('users.departments_id',$userdepartment->departments_id)
        ->where('validation',0)
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
        
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
        })
        ->select('compensations.*', 'vali.*')
        ->count();
            
        
        
        
        }
        else{
            $employees = DB::table('users')
    ->leftJoin('compensations', 'users.id', '=', 'compensations.Updated_By')
    ->leftJoin('vali', 'vali.Order_ID', '=', 'compensations.Order_ID')
          ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.departments_id', $userdepartment->departments_id)
    ->select(
        'users.id',
        'users.name',
        'users.email',
        DB::raw('COUNT(compensations.Order_ID ) as compensations_count'),
        DB::raw('COUNT(CASE WHEN vali.validation = 0 THEN 1 END) as validation_wrong'),
        DB::raw('COUNT(CASE WHEN vali.validation = 1 THEN 1 END) as validation_right')
    )
    ->groupBy(
        'users.id',
        'users.name',
        'users.email'
    )
    ->get();

        $Allusers=DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.departments_id', $userid)
        ->select('users.*','departments.*')
        ->get();
        $userdepartments = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.id', $userid)
        ->select('users.departments_id','departments.*')
        ->get(); // ✅ returns a single stdClass object


        $id=$userid;
        $teams = DB::table('teammss')
        ->join('departments', 'teammss.depart_id', '=', 'departments.ID')
        ->join('users', 'users.departments_id', '=', 'departments.ID')
        ->where('teammss.depart_id', $userdepartment->departments_id)
        ->select('teammss.*','departments.*,users.*')
        ->get(); // ✅ returns a single stdClass object
    $totalaction = DB::table('compensations')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.departments_id',$userdepartment->departments_id)
        ->select('compensations.*')
       
       
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
    
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
            
        })
        ->count();

        $teams = DB::table('teammss')
        ->join('departments', 'teammss.depart_id', '=', 'departments.ID')
        ->where('teammss.depart_id', $userdepartment->departments_id)
        ->select('teammss.*','departments.*')
        ->get(); // ✅ returns a single stdClass object
        $compensation = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
        ->join('users', 'users.id', '=', 'compensations.Updated_By')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->select('compensations.*','users.*','departments.*')
            ->where('users.departments_id',$userdepartment->departments_id)
        ->where('vali.validation', 0)
       
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
    
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
        })
        ->select('compensations.*','users.*', 'vali.*')
        ->get();

        $reasons = DB::table('compensations')
        ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
        ->join('users', 'users.id', '=', 'compensations.Updated_By')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
       
            ->select('compensations.*','users.name as Employee','departments.*')
            ->where('users.departments_id',$userdepartment->departments_id)
        ->where('vali.reasonid', 0)
       
        ->where(function ($query) use ($request) {
            if ($request->filled('orderid')) {
                $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
            }
    
            if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                $query->orWhereBetween('compensations.UpdatedOn', [
                    $request->firstcreatedon_date,
                    $request->secondcreatedon_date
                ]);
            }
        })
        ->select('compensations.*','users.*', 'vali.*')
        ->get();
$wrongactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->select('compensations.*','users.*','departments.*')
    ->where('users.departments_id',$userdepartment->departments_id)
->where('validation',0)


->where(function ($query) use ($request) {
    if ($request->filled('orderid')) {
        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
    }

    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
        $query->orWhereBetween('compensations.UpdatedOn', [
            $request->firstcreatedon_date,
            $request->secondcreatedon_date
        ]);
      
    }
})
->select('compensations.*', 'vali.*')
->count();
$rightactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->select('compensations.*','users.*','departments.*')
    ->where('users.departments_id',$userdepartment->departments_id)
->where('validation',1)

->where(function ($query) use ($request) {
    if ($request->filled('orderid')) {
        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
    }

    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
        $query->orWhereBetween('compensations.UpdatedOn', [
            $request->firstcreatedon_date,
            $request->secondcreatedon_date
        ]);
    }
})
->select('compensations.*', 'vali.*')
->count();
$wrongreasoncount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->select('compensations.*','users.*','departments.*')
    
    ->where('users.departments_id',$userdepartment->departments_id)
->where('validation',0)
->where(function ($query) use ($request) {
    if ($request->filled('orderid')) {
        $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
    }

    if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
        $query->orWhereBetween('compensations.UpdatedOn', [
            $request->firstcreatedon_date,
            $request->secondcreatedon_date
        ]);
    }
})
->select('compensations.*', 'vali.*')
->count();
    


    }
    
        }}
    return view('modals', [
        'users' => $users,
        'employees' => $employees,
        'userdepartments' =>  $userdepartments ,
        'totalaction'=> $totalaction,
        'rightactionscount'=> $rightactionscount,
        'wrongactionscount'=> $wrongactionscount,
        'wrongreasoncount'=> $wrongreasoncount,
        'compensations' => $compensation,
        'reasons' => $reasons,
        'teams' => $teams,
        'Allusers'=>$Allusers,
        'id'=>$id
     ]);
    

}
public function searches(Request $request)
{
     
    $userid=$request->userid;
    $users = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->join('tilte', 'users.tilte_id', '=', 'tilte.ID')
    ->where('users.id',$userid)
    ->select('users.*','departments.*','tilte.*')
    ->first();
    $deparment = DB::table('departments')  
    ->select('departments.*')
    ->get(); // ✅ returns a single stdClass object
    $selectedTeam = $request->input('teams');
    $selecteduser = $request->input('usersids');
    $selecteddepartment=$request->input('department');
    if ($selecteduser && $selecteduser !== 'All'){

        $deparments =  DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.id', $selecteduser)
        ->select('users.departments_id','departments.*')
        ->get(); // ✅ returns a single stdClass object
    $Allusers=DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->where('users.departments_id', $selecteddepartment)
    ->select('users.*','departments.*')
    ->get();
    $userdepartments = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->where('users.id', $userid)
    ->select('users.departments_id','departments.*')
    ->get(); // ✅ returns a single stdClass object


    $id=$userid;
  
$totalaction = DB::table('compensations')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->select('compensations.*','users.*','departments.*')
    ->where('users.departments_id',$selecteddepartment)
    ->where('users.id',$selecteduser)
    ->select('compensations.*')
   
   
    ->where(function ($query) use ($request) {
        if ($request->filled('orderid')) {
            $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
        }

        if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
            $query->orWhereBetween('compensations.UpdatedOn', [
                $request->firstcreatedon_date,
                $request->secondcreatedon_date
            ]);
        }
        
    })
    ->count();

    $teams = DB::table('teammss')
    ->join('departments', 'teammss.depart_id', '=', 'departments.ID')
    ->where('teammss.depart_id', $selecteddepartment)
    ->select('teammss.*','departments.*')
    ->get(); // ✅ returns a single stdClass object
    $compensation = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.departments_id',$selecteddepartment)
        ->where('users.id',$selecteduser)
    ->where('vali.validation', 0)
   
    ->where(function ($query) use ($request) {
        if ($request->filled('orderid')) {
            $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
        }

        if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
            $query->orWhereBetween('compensations.UpdatedOn', [
                $request->firstcreatedon_date,
                $request->secondcreatedon_date
            ]);
        }
    })
    ->select('compensations.*','users.*', 'vali.*')
    ->get();

    $reasons = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
   
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.name as Employee','departments.*')
        ->where('users.departments_id',$selecteddepartment)
        ->where('users.id',$selecteduser)
    ->where('vali.reasonid', 0)
   
    ->where(function ($query) use ($request) {
        if ($request->filled('orderid')) {
            $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
        }

        if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
            $query->orWhereBetween('compensations.UpdatedOn', [
                $request->firstcreatedon_date,
                $request->secondcreatedon_date
            ]);
        }
    })
    ->select('compensations.*','users.*', 'vali.*')
    ->get();
$wrongactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
->select('compensations.*','users.*','departments.*')
->where('users.departments_id',$selecteddepartment)
->where('users.id',$selecteduser)
->where('validation',0)


->where(function ($query) use ($request) {
if ($request->filled('orderid')) {
    $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
}

if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
    $query->orWhereBetween('compensations.UpdatedOn', [
        $request->firstcreatedon_date,
        $request->secondcreatedon_date
    ]);
  
}
})
->select('compensations.*', 'vali.*')
->count();
$rightactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
->select('compensations.*','users.*','departments.*')
->where('users.departments_id',$selecteddepartment)
->where('users.id',$selecteduser)
->where('validation',1)

->where(function ($query) use ($request) {
if ($request->filled('orderid')) {
    $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
}

if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
    $query->orWhereBetween('compensations.UpdatedOn', [
        $request->firstcreatedon_date,
        $request->secondcreatedon_date
    ]);
}
})
->select('compensations.*', 'vali.*')
->count();
$wrongreasoncount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
->select('compensations.*','users.*','departments.*')
->where('users.id',$selecteduser)

->where('users.departments_id',$selecteddepartment)
->where('users.id',$selecteduser)
->where('validation',0)
->where(function ($query) use ($request) {
if ($request->filled('orderid')) {
    $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
}

if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
    $query->orWhereBetween('compensations.UpdatedOn', [
        $request->firstcreatedon_date,
        $request->secondcreatedon_date
    ]);
}
})
->select('compensations.*', 'vali.*')
->count();





    }
    
    else{ if ($selectedTeam && $selectedTeam !== 'All')
        {

            $Allusers = DB::table('users')
            ->join('teammss', 'users.current_team_id', '=', 'teammss.team_id')
            ->where('users.current_team_id', $selectedTeam)
            ->select('users.*', 'teammss.*')
            ->get();
        $userdepartments = DB::table('users')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->where('users.id', $userid)
        ->select('users.departments_id','departments.*')
        ->get(); // ✅ returns a single stdClass object


        $id=$userid;
        $totalaction = DB::table('compensations')
        ->join('users', 'users.id', '=', 'compensations.Updated_By')
        ->join('departments', 'users.departments_id', '=', 'departments.ID')
            ->select('compensations.*','users.*','departments.*')
            ->where('users.departments_id',$selecteddepartment)
            ->select('compensations.*')
           
            ->where('users.current_team_id', $request->teams)
            ->where(function ($query) use ($request) {
                if ($request->filled('orderid')) {
                    $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
                }
        
                if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                    $query->orWhereBetween('compensations.UpdatedOn', [
                        $request->firstcreatedon_date,
                        $request->secondcreatedon_date
                    ]);
                }
            })
            ->count();
            
            $teams = DB::table('teammss')
            ->join('departments', 'teammss.depart_id', '=', 'departments.ID')
            ->where('teammss.depart_id', $selecteddepartment)
            ->select('teammss.*','departments.*')
            ->get(); // ✅ returns a single stdClass object
            $compensation = DB::table('compensations')
            ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
            ->join('users', 'users.id', '=', 'compensations.Updated_By')
            ->join('departments', 'users.departments_id', '=', 'departments.ID')
                ->select('compensations.*','users.*','departments.*')
                ->where('users.departments_id',$selecteddepartment)
            ->where('vali.validation', 0)
            ->where('users.current_team_id', $request->teams)
            ->where(function ($query) use ($request) {
                if ($request->filled('orderid')) {
                    $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
                }
        
                if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                    $query->orWhereBetween('compensations.UpdatedOn', [
                        $request->firstcreatedon_date,
                        $request->secondcreatedon_date
                    ]);
                }
            })
            ->select('compensations.*','users.*', 'vali.*')
            ->get();

            $reasons = DB::table('compensations')
            ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
            ->join('users', 'users.id', '=', 'compensations.Updated_By')
          
            ->join('departments', 'users.departments_id', '=', 'departments.ID')
                ->select('compensations.*','users.name as Employee','departments.*')
                ->where('users.departments_id',$selecteddepartment)
            ->where('vali.reasonid', 0)
            ->where('users.current_team_id', $request->teams)
            ->where(function ($query) use ($request) {
                if ($request->filled('orderid')) {
                    $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
                }
        
                if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
                    $query->orWhereBetween('compensations.UpdatedOn', [
                        $request->firstcreatedon_date,
                        $request->secondcreatedon_date
                    ]);
                }
            })
            ->select('compensations.*','users.*', 'vali.*')
            ->get();
    $wrongactionscount = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.departments_id',$selecteddepartment)
    ->where('validation',0)
    
    ->where('users.current_team_id', $request->teams)
    ->where(function ($query) use ($request) {
        if ($request->filled('orderid')) {
            $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
        }
    
        if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
            $query->orWhereBetween('compensations.UpdatedOn', [
                $request->firstcreatedon_date,
                $request->secondcreatedon_date
            ]);
          
        }
    })
    ->select('compensations.*', 'vali.*')
    ->count();
    $rightactionscount = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.departments_id',$selecteddepartment)
    ->where('validation',1)
    ->where('users.current_team_id', $request->teams)
    ->where(function ($query) use ($request) {
        if ($request->filled('orderid')) {
            $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
        }
    
        if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
            $query->orWhereBetween('compensations.UpdatedOn', [
                $request->firstcreatedon_date,
                $request->secondcreatedon_date
            ]);
        }
    })
    ->select('compensations.*', 'vali.*')
    ->count();
    $wrongreasoncount = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.current_team_id', $request->teams)
        ->where('users.departments_id',$selecteddepartment)
    ->where('validation',0)
    ->where(function ($query) use ($request) {
        if ($request->filled('orderid')) {
            $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
        }
    
        if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
            $query->orWhereBetween('compensations.UpdatedOn', [
                $request->firstcreatedon_date,
                $request->secondcreatedon_date
            ]);
        }
    })
    ->select('compensations.*', 'vali.*')
    ->count();
        
    
    
    
    }
    else{

    $Allusers=DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->where('users.departments_id', $userid)
    ->select('users.*','departments.*')
    ->get();
    $userdepartments = DB::table('users')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->where('users.id', $userid)
    ->select('users.departments_id','departments.*')
    ->get(); // ✅ returns a single stdClass object


    $id=$userid;
  
$totalaction = DB::table('compensations')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
    ->select('compensations.*','users.*','departments.*')
    ->where('users.departments_id',$selecteddepartment)
    ->select('compensations.*')
   
   
    ->where(function ($query) use ($request) {
        if ($request->filled('orderid')) {
            $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
        }

        if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
            $query->orWhereBetween('compensations.UpdatedOn', [
                $request->firstcreatedon_date,
                $request->secondcreatedon_date
            ]);
        }
        
    })
    ->count();

    $teams = DB::table('teammss')
    ->join('departments', 'teammss.depart_id', '=', 'departments.ID')
    ->where('teammss.depart_id', $selecteddepartment)
    ->select('teammss.*','departments.*')
    ->get(); // ✅ returns a single stdClass object
    $compensation = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
        ->select('compensations.*','users.*','departments.*')
        ->where('users.departments_id',$selecteddepartment)
    ->where('vali.validation', 0)
   
    ->where(function ($query) use ($request) {
        if ($request->filled('orderid')) {
            $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
        }

        if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
            $query->orWhereBetween('compensations.UpdatedOn', [
                $request->firstcreatedon_date,
                $request->secondcreatedon_date
            ]);
        }
    })
    ->select('compensations.*','users.*', 'vali.*')
    ->get();

    $reasons = DB::table('compensations')
    ->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
    ->join('users', 'users.id', '=', 'compensations.Updated_By')
    ->join('departments', 'users.departments_id', '=', 'departments.ID')
  
        ->select('compensations.*','users.name as Employee*','departments.*')
        ->where('users.departments_id',$selecteddepartment)
    ->where('vali.reasonid', 0)
   
    ->where(function ($query) use ($request) {
        if ($request->filled('orderid')) {
            $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
        }

        if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
            $query->orWhereBetween('compensations.UpdatedOn', [
                $request->firstcreatedon_date,
                $request->secondcreatedon_date
            ]);
        }
    })
    ->select('compensations.*','users.*', 'vali.*')
    ->get();
$wrongactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
->select('compensations.*','users.*','departments.*')
->where('users.departments_id',$selecteddepartment)
->where('validation',0)


->where(function ($query) use ($request) {
if ($request->filled('orderid')) {
    $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
}

if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
    $query->orWhereBetween('compensations.UpdatedOn', [
        $request->firstcreatedon_date,
        $request->secondcreatedon_date
    ]);
  
}
})
->select('compensations.*', 'vali.*')
->count();
$rightactionscount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
->select('compensations.*','users.*','departments.*')
->where('users.departments_id',$selecteddepartment)
->where('validation',1)

->where(function ($query) use ($request) {
if ($request->filled('orderid')) {
    $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
}

if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
    $query->orWhereBetween('compensations.UpdatedOn', [
        $request->firstcreatedon_date,
        $request->secondcreatedon_date
    ]);
}
})
->select('compensations.*', 'vali.*')
->count();
$wrongreasoncount = DB::table('compensations')
->join('vali', 'compensations.Order_ID', '=', 'vali.Order_ID')
->join('users', 'users.id', '=', 'compensations.Updated_By')
->join('departments', 'users.departments_id', '=', 'departments.ID')
->select('compensations.*','users.*','departments.*')

->where('users.departments_id',$selecteddepartment)
->where('validation',0)
->where(function ($query) use ($request) {
if ($request->filled('orderid')) {
    $query->where('compensations.Order_ID', 'like', '%' . $request->orderid . '%');
}

if ($request->filled('firstcreatedon_date') && $request->filled('secondcreatedon_date')) {
    $query->orWhereBetween('compensations.UpdatedOn', [
        $request->firstcreatedon_date,
        $request->secondcreatedon_date
    ]);
}
})
->select('compensations.*', 'vali.*')
->count();



}

    }
  

    return view('admin', [
        'users' => $users,
        'userdepartments' =>  $userdepartments ,
        'department'=>  $deparment ,
        'totalaction'=> $totalaction,
        'rightactionscount'=> $rightactionscount,
        'wrongactionscount'=> $wrongactionscount,
        'wrongreasoncount'=> $wrongreasoncount,
        'compensations' => $compensation,
        'reasons' => $reasons,
        'teams' => $teams,
        'Allusers'=>$Allusers,
        'id'=>$id
     ]);
    
    
}}