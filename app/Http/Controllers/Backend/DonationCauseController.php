<?php
namespace App\Http\Controllers\Backend;

use Session;
use App\Models\DonationCause;
use DB;
use Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationCauseController extends Controller
{

    public function index()
    {
        $donationCauses = DonationCause::paginate(12);
        //dd($product);
        return view('backend.donationCause.index', compact('donationCauses'));
    }

    public function create()
    {
        $donationCauses = DonationCause::all();
        return view('backend.donationCause.create', compact('donationCauses'));
    }

    public function store(Request $request)
    {
        //    dd($request->all());
        $this->validate($request, 
        [
            'title' => 'required',
            'desc' => 'required',
            'maximum_amount' => 'required',
            'duration' => 'required',
            'img' => 'required'
        ]);
        $data = new DonationCause();
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->desc = $request->desc;
        $data->maximum_amount = $request->maximum_amount;
        $data->duration = $request->duration;
        if ($request->hasfile('img'))
        {
            $image = $request->file('img');
            $img = time() . $image->getClientOriginalName();
            $path = 'storage/donationCause/';
            $upload = $image->move($path, $img);
            $data->img = $img;
        }
        $data->save();
        return redirect('admin/donationCause')
            ->with('flash_message', 'Cause Added Successfully.');
    }

    public function edit($id)
    {
        $donationCause = DonationCause::findOrFail($id);

        return view('backend.donationCause.edit', compact('donationCause'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, 
        [
            'title' => 'required',
            'desc' => 'required',
            'maximum_amount' => 'required',
            'duration' => 'required'
        ]);
        $data = DonationCause::find($id);
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->desc = $request->desc;
        $data->maximum_amount = $request->maximum_amount;
        $data->duration = $request->duration;
        if ($request->hasfile('img'))
        {
            $image = $request->file('img');
            $img = time() . $image->getClientOriginalName();
            $path = 'storage/donationCause/';
            $upload = $image->move($path, $img);
            $data->img = $img;
        }
        $data->update();
        return redirect('admin/donationCause')
            ->with('flash_message', 'Cause Updated Successfully.');
    }

    public function delete($id)
    {
        $cause = DonationCause::findOrFail($id);
        $cause->delete();
        return redirect('admin/donationCause')
            ->with('flash_message', 'Cause Deleted Successfully.');
    }
}

