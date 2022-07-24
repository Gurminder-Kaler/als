<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobTitle;
use Str;

class JobTitleController extends Controller
{

    public function index()
    {
        $jobTitles = JobTitle::all();

        return view('backend.jobTitle.index', compact('jobTitles'));
    }

    public function create()
    {
        $jobTitles = JobTitle::all();
        return view('backend.jobTitle.create', compact('jobTitles'));
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
        $data = new JobTitle();
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->save();
        return redirect('admin/jobTitle')->with('flash_message', 'JobTitle Added Successfully.');
    }

    public function show($id)
    {
        $jobTitle = JobTitle::findOrFail($id);
        return view('backend.jobTitle.show', compact('jobTitle'));
    }

    public function edit($id)
    {
        $jobTitle = JobTitle::findOrFail($id);
        return view('backend.jobTitle.edit', compact('jobTitle'));
    }

    public function update(Request $request, $id)
    {
        $data = JobTitle::find($id);
        $data->title = $request->title;
        $data->update();
        return redirect('admin/jobTitle')->with('flash_message', 'JobTitle Updated Successfully.');
    }

    public function delete($id)
    {
        $jobTitle = JobTitle::findOrFail($id);
        $jobTitle->delete();
        return redirect('admin/jobTitle')->with('flash_message', 'JobTitle Deleted Successfully.');
    }

    public function jobTitleStatus(Request $request)
    {
        $id = $request->id;
        $data = JobTitle::find($id);
        if ($data->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->update();
    }
}
