<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products\Colors;
use App\Models\Products\Images;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Products::all();
        return view('admin.product.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Categories::all();
        return view('admin.product.add',compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|min:3|max:191|unique:products',
            'slug'=>'required|alpha_dash|min:3|max:100|unique:products',
            'category_id'=>'required|numeric',
            'description'=>'required|min:3',
            'small_description'=>'required|min:3|max:255',
            'original_price'=>'required|numeric|min:1',
            'selling_price'=>'required|numeric|min:1',
            'total_price'=>'required|numeric|min:1',
            'offer'=>'nullable|numeric|between:1,99',
            'tax'=>'nullable|numeric|min:1',
            'meta_title'=>'nullable|min:3|max:255',
            'meta_description'=>'nullable|min:3',
            'meta_keywords'=>'nullable|min:3',
            'image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:5242880',

            //color
            'color_name'=>'required|min:2|max:191',
            'color'=>'required|min:2|max:191',
            'qty'=>'required|numeric'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $product = new Products();

            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().$request->slug.$extention;
                $file->move('uploads/ecommerce/product/', $filename);
                $product->image = $filename;
            }

            $product->category_id = $request->input('category_id');
            $product->name = $request->input('name');
            $product->slug = $request->input('slug');
            $product->description = $request->input('description');
            $product->small_description = $request->input('small_description');
            $product->original_price = $request->input('original_price');
            $product->selling_price = $request->input('selling_price');
            $product->total_price = $request->input('total_price');
            $product->offer = $request->input('offer');
            $product->tax = $request->input('tax');
            $product->status = $request->input('status') == True ? '1':'0';
            $product->trending = $request->input('trending') == True ? '1':'0';
            $product->meta_title = $request->input('meta_title');
            $product->meta_description = $request->input('meta_description');
            $product->meta_keywords = $request->input('meta_keywords');
            $product->save();

            //color
              $color = new Colors();
              $color->product_id = $product->id;
              $color->name = $request->input('color_name');
              $color->color = $request->input('color');
              $color->qty = $request->input('qty');
              $color->save();

            return redirect('/admin/products')->with('status','Product Added Successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = Products::findOrFail($id);
        return view('Admin.product.show',compact('prod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Categories::all();
        $prod = Products::findOrFail($id);
        return view('Admin.product.edit',compact('prod','cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name'=>['required','min:3','max:191',Rule::unique('products')->ignore($product->id,'id')],
            'slug'=>['required','alpha_dash','min:3','max:100',Rule::unique('products')->ignore($product->id,'id')],
            'category_id'=>'required|numeric',
            'description'=>'required|min:3',
            'small_description'=>'required|min:3|max:255',
            'original_price'=>'required|numeric|min:1',
            'selling_price'=>'required|numeric|min:1',
            'total_price'=>'required|numeric|min:1',
            'offer'=>'nullable|numeric|between:1,99',
            'tax'=>'nullable|numeric|min:1',
            'meta_title'=>'nullable|min:3|max:255',
            'meta_description'=>'nullable|min:3',
            'meta_keywords'=>'nullable|min:3',
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5242880',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            if($request->hasfile('image'))
            {
                $destination = 'uploads/ecommerce/product/'.$product->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().$request->slug.$extention;
                $file->move('uploads/ecommerce/product/', $filename);
                $product->image = $filename;
            }
            $product->category_id = $request->input('category_id');
            $product->name = $request->input('name');
            $product->slug = $request->input('slug');
            $product->description = $request->input('description');
            $product->small_description = $request->input('small_description');
            $product->original_price = $request->input('original_price');
            $product->selling_price = $request->input('selling_price');
            $product->total_price = $request->input('total_price');
            $product->offer = $request->input('offer');
            $product->tax = $request->input('tax');
            $product->status = $request->input('status') == True ? '1':'0';
            $product->trending = $request->input('trending') == True ? '1':'0';
            $product->meta_title = $request->input('meta_title');
            $product->meta_description = $request->input('meta_description');
            $product->meta_keywords = $request->input('meta_keywords');
            $product->update();
            
            return redirect('/admin/products')->with('status','Product Edited Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Products::findOrFail($id);

        $img = Images::where('product_id', $id)->get();
        if(isset($img)){
            foreach ($img as $image) {
                $destination = 'uploads/ecommerce/product/'.$image->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
            }
            Images::where('product_id', $id)->delete();
        } 
        
        $color = Colors::where('product_id', $id)->get();
        if(isset($color)){
            Colors::where('product_id', $id)->delete();
        }

        $destination = 'uploads/ecommerce/product/'.$prod->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $prod->delete();
        return response()->json(['status'=>'Product '.$prod->name. ' deleted successfully']);
    }
}
