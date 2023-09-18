<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Settings;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id','DESC')->paginate(10);
        return view('vendor.order.index')->with('orders',$orders);
    }

    public function show($id)
    {
        $order= Order::find($id);
        return view('vendor.order.show')->with('order',$order);
    }
    
    public function edit($id)
    {
        $order= Order::find($id);
        return view('vendor.order.edit')->with('order',$order);
    }

    public function update(Request $request, $id)
    {
        $order=Order::find($id);
        $this->validate($request,[
            'status'=>'required|in:new,process,delivered,cancel'
        ]);
        $setting=$request->all();
        // return $request->status;
        if($request->status=='delivered'){
            foreach($order->cart as $cart){
                $product=$cart->product;
                // return $product;
                $product->stock -=$cart->quantity;
                $product->save();
            }
        }
        $status=$order->fill($setting)->save();
        if($status){
            request()->session()->flash('success','Successfully updated order');
        }
        else{
            request()->session()->flash('error','Error while updating order');
        }
        return redirect()->route('order.index');
    }


    // PDF generate
    public function pdf(Request $request){
        $order=Order::getAllOrder($request->id);
        $setting = Settings::first();
        // return $order;
        $file_name=$order->order_number.'-'.$order->first_name.'.pdf';
        // return $file_name;
        $pdf=PDF::loadview('vendor.order.pdf',compact('order','setting'));
        return $pdf->download($file_name);
    }
}
