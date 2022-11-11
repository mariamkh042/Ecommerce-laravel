<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Products;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishListController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $wishlist = Wishlist::where('user_id',Auth::user()->id)->get();
            return view('frontend.wishlist',compact('wishlist'));
        }else{
            return back()->with('error','Please login to continue');
        }
    }
    
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id'=>'required|numeric',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator);
        }else{
            if(Auth::check()){
                $product_id = $request->product_id;
                $prod_check = Products::where('id',$product_id)->first();
                if($prod_check){
                    if(Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->exists()){
                        return back()->with('error' ,$prod_check->name." already added to wishlist");
                    }else{
                        $wish = new Wishlist;
                        $wish->product_id = $product_id;
                        $wish->user_id = Auth::user()->id;
                        $wish->save();
                        return back()->with('status',$prod_check->name.' added to wishlist');
                    }
                }else{
                    return back()->with('error','Product doesn\'t exist');
                }
             }else{
                 return back()->with('error','Please login to continue');
             }
        }
       
    }

    public function delete(Request $request)
    {
        if(Auth::check()){
            $prod_id = $request->prod_id;
            $prod_name = $request->prod_name;
            if(Wishlist::where('product_id',$prod_id)->where('user_id',Auth::user()->id)->exists()){
                $wish = Wishlist::where('product_id',$prod_id)->where('user_id',Auth::user()->id)->first();
                $wish->delete();
                return response()->json(['status'=>$prod_name.' removed from wishlist']);
            }
        }else{
            return back()->with('error',"Login to continue");
        }
    }
}
