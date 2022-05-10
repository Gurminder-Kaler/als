<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;
use App\Models\Order;
use PDF;

class OrderController extends Controller
{
    //
    public function downloadInvoice($id)
    {   
        // dd($id);
        $order = Order::where('order_id',$id)->first();
       // This  $data array will be passed to our PDF blade
       $data = [
          'order' => $order,   
            ];
        
        $pdf = PDF::loadView('invoice', $data);  
        return $pdf->download('invoice.pdf');
 
    }
    public function index(){
        $orders = Order::all();
        
    	return view('backend.order.index',compact('orders'));
    }

    public function detailPage($id){
    	$order = Order::find($id);
        // dd($order);
    	return view('backend.order.detail',compact('order'));
    }
    public function changeOrderStatus(Request $request){
        $order  = Order::find($request->id);
        $order->status = $request->value;
        $order->update();
        return response(['success'=>true]);
    }
}
