<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $orders = Orders::where('user_id',Auth::user()->id)->get();
            if($orders->count()>0){
                return view('frontend.orders.index',compact('orders'));       
            }else{
                return abort(404);
            }
        }else{
            return back()->with('error','Login to continue to order');
        }
       
    }

    public function show($id)
    {
        $order = Orders::findOrFail($id)->where('user_id',Auth::id())->first();
        return view('frontend.orders.show',compact('order'));    
    }
}
