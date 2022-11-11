<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        //pending orders
        $orders=Orders::where('status','0')->get();
        return view('admin.order.index',compact('orders'));
    }

    public function show($id)
    {
        $order=Orders::findOrFail($id);
        return view('admin.order.show',compact('order'));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'status' => ['required','numeric','digits:1'],
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $orders = Orders::findOrFail($id);
            $orders->status = $request->status;
            $orders->update();
            return redirect('admin/orders')->with('status','Order Updated Successfully');
        }
    }

    public function orderHistory()
    {
        $orders=Orders::where('status','1')->get();
        return view('admin.order.history',compact('orders'));
    }
}