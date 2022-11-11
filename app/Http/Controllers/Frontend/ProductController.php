<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products\Colors;
use App\Models\Products\Images;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function viewcategory($slug)
    {
        if(Categories::where('slug',$slug)->exists()){
            $category = Categories::where('slug',$slug)->first();
            $products = Products::where('category_id',$category->id)->get();
            return view('frontend.products.index',compact('category','products'));

        }else{
            return redirect('/')->with('error','No such category found');
        }
    }

    public function viewproduct($cat_slug,$prod_slug)
    {
        if(Categories::where('slug',$cat_slug)->exists()){
            if(Products::where('slug',$prod_slug)->exists()){
                $category = Categories::where('slug',$cat_slug)->first();

                $products = Products::where('slug',$prod_slug)->first();

                $prod_img = Images::where('product_id',$products->id)->get();

                $prod_color = Colors::where('product_id',$products->id)->get();

                return view('frontend.products.show',compact('products','category','prod_img','prod_color'));
            }else {
                return redirect('/')->with('error','The link was broken');
            }
        }else{
            return redirect('/')->with('error','No such category found');
        }
    }
}
