<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Team;
use App\Models\JobTitle;
use App\Models\Budget;

use App\Repositories\UserRepositoryInterface;
use Spatie\Permission\Models\Role;
// use DB;
// use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Arr;
    
class UserController extends Controller
{


    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(10);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    


    public function create()
    {
        $jobTitles = JobTitle::all();
        $departments = Department::all();
        $teams = Team::all();
        $budgets = Budget::all();
        $roles = Role::all();

        return view('users.create',compact('roles', 'jobTitles', 'departments', 'teams', 'budgets'));
    }

    

    public function store(UserStoreRequest $request)
    {
        if( $request->has('status')){
            $status = 1;
        }else{
            $status = 0;
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->department_id = $request->department_id;
        $user->team_id = $request->team_id;
        $user->job_title_id = $request->job_title_id;
        $user->budget_id = $request->budget_id;
        $user->status = $status;
        $user->save();

        $user->roles()->sync($request->roles);
    
        return redirect()->route('users.index')
                        ->with('message','User Created Successfully');
    }
    

    
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    

    

    public function edit($id)
    {
        $user = User::find($id);

        $jobTitles = JobTitle::all();
        $departments = Department::all();
        $teams = Team::all();
        $budgets = Budget::all();
        $roles = Role::all();

        return view('users.edit',compact('user', 'roles', 'jobTitles', 'departments', 'teams', 'budgets'));
    }

    

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        
        if( $request->has('status')){
            $status = 1;
        }else{
            $status = 0;
        }
    
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->department_id = $request->department_id;
        $user->team_id = $request->team_id;
        $user->job_title_id = $request->job_title_id;
        $user->budget_id = $request->budget_id;
        $user->status = $status;
        $user->save();

        $user->roles()->sync($request->roles);

        //DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        //$user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    

    
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}