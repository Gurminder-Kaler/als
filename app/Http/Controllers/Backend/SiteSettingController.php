<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;

class SiteSettingController extends Controller
{

   public function index()
   {
       $siteSetting = SiteSetting::find(1);
       //dd($siteSetting);
       return view('backend.siteSetting.index', compact('siteSetting'));
   } 
 
   public function update(Request $request)
   { 
      $data = SiteSetting::find(1);
      $data->address = $request->address;
      $data->contact_email = $request->contact_email;
      $data->phone_one = $request->phone_one;
      $data->phone_two = $request->phone_two;
      $data->website = $request->website;
      $data->facebook = $request->facebook;
      $data->twitter = $request->twitter;
      $data->instagram = $request->instagram;
      $data->privacy_policy = $request->privacy_policy;
      $data->map_address = $request->map_address;
      $data->youtube = $request->youtube;
      $data->whatsapp = $request->whatsapp;
      if($request->hasfile('logo'))
      {
         $image = $request->file('logo');
         $logo = time().$image->getClientOriginalName();
         $path = 'storage/logo/';
         $upload = $image->move($path, $logo);
         $data->logo = $logo;
      }

      $data->update();
      return redirect()->back()->with('flash_message','SiteSetting Updated Successfully.');
   }
 
}
