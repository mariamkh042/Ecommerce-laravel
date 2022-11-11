<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products\Colors;
use App\Models\Products\Images;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $new_products_id = Products::where('status','1')->select('category_id')->get();
        $new_products_category = Categories::find($new_products_id);

        $featured_products_id = Products::where('trending','1')->select('category_id')->get();
        $featured_products_category = Categories::find($featured_products_id);

        $popular_cat = Categories::where('popular','1')->take(15)->get();
        return view('frontend.home',compact('popular_cat','new_products_category','featured_products_category'));
    }

    public function Category()
    {
        $new_cat = Categories::where('status','1')->get();
        $popular_cat = Categories::where('popular','1')->get();
        $category = Categories::all();
        return view('frontend.category',compact('category','new_cat','popular_cat'));
    }

    public function productList()
    {
        $products = Products::select('name')->get();
        $data = [];
        foreach($products as $prod){
            $data[] = $prod['name'];
        }
        return $data;
    }

    public function searchProduct(Request $request)
    {
        $search_product = $request->product_name;
        if($search_product != ""){
            $product = Products::where("name","LIKE","%$search_product%")->first();
            if($product){
                return redirect('category/'.$product->category->slug.'/'.$product->slug);
            }else{
                return back()->with('error','No products match your search');
            }
        }else{
            return back();
        }
    }

}
