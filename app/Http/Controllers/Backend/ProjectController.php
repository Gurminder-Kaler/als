<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;
use App\Models\Project;
use App\Models\Department;
use App\Models\ProjectDepartment;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(12);
        return view('backend.project.index', compact('projects'));
    }

    public function create()
    {
        $projects = Project::all();
        $departments = Department::where('deleted_at', null)->get(); 
        return view('backend.project.create', compact('projects', 'departments'));
    }

    public function getAllProjectsViaDepartmentId($department_id)
    {
        $html = '';
        $projectDepartments = ProjectDepartment::where('department_id', $department_id)->where('deleted_at', null)->get();
        // dd($projectDepartments);
        $html .= '<select class="form-control" id="project_id" required name="project_id">';
        
        if (isset($projectDepartments) && $projectDepartments->count() > 0) {
            foreach ($projectDepartments as $pd) {
                $html .= '<option selected disabled >Select the project</option>';
                $html .= '<option value="' . $pd->project_id . '">' . $pd->project->title . '</option>';
            }
        } else {
            $html .= '<option > No Options found in this department </option>';
        }
        $html .= "</select> ";
        return ['success' => true, 'html' => $html];
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'desc' => 'required',
                'img' => 'required'

            ]
        );
        $data = new Project;
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->desc = $request->desc;
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . $image->getClientOriginalName();
                $path = 'storage/project';
                $image->move($path, $name);
                $data1[] = $name;
            }
            $image_str = implode(';', $data1);
            $data->images = $image_str;
        }
        if ($request->hasfile('img')) {
            $image = $request->file('img');
            $img = time() . $image->getClientOriginalName();
            $path = 'storage/project/';
            $image->move($path, $img);
            $data->img = $img;
            if ($request->hasfile('images') == false) {
                $data->images = $img;
            }
        }

        $data->save();
        return redirect('admin/project')->with('flash_message', 'Project Added Successfully.');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('backend.project.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('backend.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'desc' => 'required',
            ]
        );
        $data = Project::find($id);
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->desc = $request->desc;
        if ($request->hasfile('img')) {
            $image = $request->file('img');
            $img = time() . $image->getClientOriginalName();
            $path = 'storage/project/';
            $image->move($path, $img);
            $data->img = $img;
        }
        if (isset($request->img_c)) {
            $pimage_str = implode(';', $request->img_c);
            $data->images = $pimage_str;
        } else {
            $data->images = null;
        }
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . $image->getClientOriginalName();
                $path = 'storage/project';
                $image->move($path, $name);
                $data1[] = $name;
            }
            $image_str = implode(';', $data1);
            $data->images = $image_str;
            if (isset($request->img_c)) {
                $data->images = $image_str . ';' . $pimage_str;
            }
        }
        $data->update();
        return redirect('admin/project')->with('flash_message', 'Project Updated Successfully.');
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect('admin/project')->with('flash_message', 'Project Deleted Successfully.');
    }

    public function projectStatus(Request $request)
    {
        $id = $request->id;
        $data = Project::find($id);
        if ($data->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->update();
    }
}
