<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{

    public function index()
    {
        $about = About::find(1);
        //dd($about);
        return view('backend.about.index', compact('about'));
    }
    
    public function show($id)
    {
        $about = About::findOrFail($id);
        return view('backend.about.show', compact('about'));
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('backend.about.edit',compact('about'));
    }

    public function update(Request $request)
    { 
            //    dd($request->all());
            $data= About::find(1); 
            $data->about = $request->about;
            if($request->hasfile('img'))
                {
                $image = $request->file('img');
                $img = time().$image->getClientOriginalName();
                $path = 'storage/about/';
                $upload = $image->move($path, $img);
                $data->img = $img;
                }

            $data->update();
            return redirect('admin/about')->with('flash_message', 'About Updated Successfully.');
    }
 
}
