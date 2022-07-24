<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Str;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::all();

        return view('backend.department.index', compact('departments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('backend.department.create', compact('departments'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate(
            $request,
            [
                'title' => 'required',
            ]
        );
        $data = new Department();
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->save();
        return redirect('admin/department')->with('flash_message', 'Department Added Successfully.');
    }

    public function show($id)
    {
        $department = Department::findOrFail($id);
        return view('backend.department.show', compact('department'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('backend.department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $data = Department::find($id);
        $data->title = $request->title;
        $data->update();
        return redirect('admin/department')->with('flash_message', 'Department Updated Successfully.');
    }

    public function delete($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect('admin/department')->with('flash_message', 'Department Deleted Successfully.');
    }

    public function sliderStatus(Request $request)
    {
        $id = $request->id;
        $data = Department::find($id);
        if ($data->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->update();
    }
}
