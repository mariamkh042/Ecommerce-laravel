<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Info;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\OrderProducts;
use App\Models\Products\Colors;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index()
    {
        if(Cart::where('user_id',Auth::user()->id)->get()->count() >= 1){
        $old_cartItems = Cart::where('user_id',Auth::user()->id)->get();
        foreach($old_cartItems as $item){
            $products = Products::where('id',$item->product_id)->get();
            foreach($products as $prod){
                $prod_qty = $prod->total_quantity($prod->id);
                $equation = $prod_qty >= $item->product_qty;
                if(!$equation){
                    $removeCart = Cart::where('user_id',Auth::user()->id)->where('product_id',$item->product_id)->first();
                    $removeCart->delete();
                }
            }
        }
        $cartItems = Cart::where('user_id',Auth::user()->id)->get();
        return view('frontend.checkout',compact('cartItems'));
        }else{
            return back()->with('error','Add items to cart First');
        }
    }

    public function placeorder(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|min:3|max:255',
            'mobile' => ['required','numeric','digits:11'],
            'phone' => ['nullable','numeric'],
            'city' =>'required|string|min:3|max:255',
            'address' =>'required|min:3',
            'pin_code' => ['required','numeric'],
            'note'=>'nullable|min:3',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        else{
            //To Calculate total price
            $total = 0;
            $cartItems_total = Cart::where('user_id',Auth::user()->id)->get();
            foreach($cartItems_total as $item){
                $total += $item->products->total_price * $item->product_qty ;
            }

            $order = new Orders();
            $order->user_id = Auth::user()->id;
            $order->name = $request->name;
            $order->email = Auth::user()->email;
            $order->mobile = $request->mobile;
            $order->phone = $request->phone;
            $order->city = $request->city;
            $order->address = $request->address;
            $order->pin_code = $request->pin_code;
            $order->note = $request->note;
            $order->total_price = $total;

            //get Name to put in tracking number
            $name = Info::select('name')->first();

            $order->tracking_no = $name->name.rand(1111,9999);
            $order->save();

            $cartItems = Cart::where('user_id',Auth::user()->id)->get();
            foreach($cartItems as $item){
                OrderProducts::create([
                    'order_id'=>$order->id,
                    'product_id'=>$item->product_id,
                    'qty'=>$item->product_qty,
                    'color'=>$item->color,
                    'price'=>$item->products->total_price
                ]);

                $qty_update = Colors::where('product_id',$item->product_id)->where('name',$item->color)->first();
                $qty_update->qty = $qty_update->qty - $item->product_qty;
            }
            $cartItems = Cart::where('user_id',Auth::user()->id)->get();
            Cart::destroy($cartItems);
            return redirect('/')->with('status','Order placed successfully');
        }
    }

    public function buyNow()
    {
        
    }
}
