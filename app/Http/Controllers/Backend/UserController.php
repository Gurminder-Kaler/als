<?php

namespace App\Http\Controllers\Backend;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\JobTitle;
use App\Models\EmployeeDetail;
use App\Models\ProjectEmployeeDetail;
use App\Models\EmployeeDetailJob;

class UserController extends Controller
{
    // user index
    public function index()
    {
        $users = User::all();
        return view('backend.user.index', compact('users'));
    }

    // user create
    public function create()
    {
        $departments = Department::where('deleted_at', null)->get();
        $jobTitles = JobTitle::where('deleted_at', null)->get();
        return view('backend.user.create', compact('departments', 'jobTitles'));
    }

    // user store
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'gender' => 'required',
                'password' => 'required',
                'email' => 'required',
                'salary' => 'required',
                'job_title_id' => 'required',
                'project_id' => 'required',
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->role = 'employee';
        if ($user->save()) {
            $employeeDetail = new EmployeeDetail();
            $employeeDetail->user_id = $user->id;
            $employeeDetail->salary = $request->salary;
            $employeeDetail->job_title_id = $request->job_title_id;
            $employeeDetail->project_id = $request->project_id;
            $employeeDetail->is_department_head = $request->is_department_head ? 1 : 0;
            $employeeDetail->department_id = $request->department_id;
            $employeeDetail->save();
            return redirect('/admin/user')->with('flash_message', 'Successfully Created Employee!');;
        } else {
            return redirect()->back()->with('error_message', 'Something went wrong!');
        }
    }

    // user update
    public function update()
    {
        return view('backend.user.update');
    }

    // user delete
    public function delete()
    {
        return view('backend.user.delete');
    }
}
