<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends Controller
{


   public function index()
   {
       $banners = Banner::all();
       //dd($banner);
       return view('backend.banner.index', compact('banners'));
   }

   public function create()
   {
   		$banner = Banner::all();
       return view('backend.banner.create',compact('banner'));
   }

   public function store(Request $request)
   {
    // dd($request->all());
    //    $this->validate(
    //        $request,
    //        [
    //            'title' => 'required',
    //            'tagline' => 'required',
    //        ]
    //    );
       $data = new Banner;
    //    $data->title = $request->title;
    //    $data->tagline = $request->tagline;
    //    $data->rlink = $request->rlink;
       if($request->hasfile('img'))
        {
           $image = $request->file('img');
           $img = time().$image->getClientOriginalName();
           $path = 'storage/banner/';
           $upload = $image->move($path, $img);
           $data->img = $img;
        }

       $data->save();
       return redirect('admin/banner')->with('flash_message', 'Banner Added Successfully.');
   }

   public function show($id)
   {
       $banner = Banner::findOrFail($id);
       return view('backend.banner.show', compact('banner'));
   }

   public function edit($id)
   {
       $banner = Banner::findOrFail($id);
       return view('backend.banner.edit',compact('banner'));
   }

   public function update(Request $request, $id)
   { 
       $data= Banner::find($id); 
       if($request->hasfile('img'))
        {
           $image = $request->file('img');
           $img = time().$image->getClientOriginalName();
           $path = 'storage/banner/';
           $upload = $image->move($path, $img);
           $data->img = $img;
        }

       $data->update();
       return redirect('admin/banner')->with('flash_message', 'Banner Updated Successfully.');
   }

   public function destroy($id)
   {
       $banner = Banner::findOrFail($id);
       $banner->delete();
       return redirect('admin/banner')->with('flash_message', 'Banner Deleted Successfully.');
   }
  
   public function sliderStatus(Request $request)
   {
       $id = $request->id;
       $data = Banner::find($id);
       if($data->status==1)
       {
           $data->status = 0;
       }
       else
       {
           $data->status = 1;
       }
       $data->update();
   }
}
