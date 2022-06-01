<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;
use App\Models\Order;
use App\Mail\OrderStatusChanged;
use PDF;
use Auth;

class OrderController extends Controller
{
    //
    public function downloadInvoice($id)
    {   
        $order = Order::where('order_id',$id)->first();
        // This $data array will be passed to our PDF blade
        $data = [
          'order' => $order,   
        ];
        
        $pdf = PDF::loadView('invoice', $data);  
        return $pdf->download('invoice.pdf');
    }

    public function index(){
        $orders = Order::orderBy('created_at', 'desc')->get();
        
    	return view('backend.order.index',compact('orders'));
    }

    public function detailPage($id){
    	$order = Order::find($id);
        // dd($order);
    	return view('backend.order.detail',compact('order'));
    }

    public function testEmail($id){
    	$order = Order::find($id);
        // dd($order);
    	return view('frontend.email.orderStatusChanged',compact('order'));
    }

    public function changeOrderStatus(Request $request){
        $order  = Order::find($request->id);
        $order->status = $request->value;
        $order->update();

        \Mail::to($order->user->email)->send(new \App\Mail\OrderStatusChanged($order));
        return response(['success'=>true]);
    }
}
