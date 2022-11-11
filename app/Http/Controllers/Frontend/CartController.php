<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id'=>'required|numeric',
            'product_qty'=>'required|numeric|min:1',
            'color'=>'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator);
        }else{
            $product_id = $request->product_id;
            $product_qty = $request->product_qty;
            $product_color = $request->color;

            if(Auth::check()){
                $prod_check = Products::where('id',$product_id)->first();
                if($prod_check){
                    if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists()){
                        return back()->with('error' ,$prod_check->name." already added to cart");
                    }else{
                        $prod_qty_origin = $prod_check->total_quantity($prod_check->id);
                        $equation = $prod_qty_origin >= $product_qty;
                        if($equation){
                            $cartItem = new Cart();
                            $cartItem->user_id = Auth::id();
                            $cartItem->product_id = $product_id;
                            $cartItem->product_qty = $product_qty;
                            $cartItem->color = $product_color;
                            $cartItem->save();
                            return back()->with('status' ,$prod_check->name." added to cart");
                        }else{
                            return back()->with('error' ,"Quantity wanted greater than that in stock");
                        }
                    }
                }
            }else{
                return back()->with('error',"Login to continue");
            }
        }
    }

    public function viewcart()
    {
        $cartItems = Cart::where('user_id',Auth::user()->id)->get();
        return view('frontend.cart',compact('cartItems'));
    }

    public function deleteProduct(Request $request)
    {
        if(Auth::check()){
            $prod_id = $request->prod_id;
            $prod_name = $request->prod_name;
            if(Cart::where('product_id',$prod_id)->where('user_id',Auth::user()->id)->exists()){
                $cartItem = Cart::where('product_id',$prod_id)->where('user_id',Auth::user()->id)->first();
                $cartItem->delete();
                return response()->json(['status'=>$prod_name.' removed from cart']);
            }
        }else{
            return back()->with('error',"Login to continue");
        }
    }

    public function updateCart(Request $request)
    {
        if(Auth::check()){
            $prod_id = $request->prod_id;
        
            if(Cart::where('product_id',$prod_id)->where('user_id',Auth::user()->id)->exists()){
                $cartItem = Cart::where('product_id',$prod_id)->where('user_id',Auth::user()->id)->first();
                if($request->prod_qty){
                    $cartItem->product_qty = $request->prod_qty;
                }
                if($request->prod_color){
                    $cartItem->color = $request->prod_color;
                }
                
                $cartItem->update();
            }
        }else{
            return back()->with('error',"Login to continue");
        }
    }
}
