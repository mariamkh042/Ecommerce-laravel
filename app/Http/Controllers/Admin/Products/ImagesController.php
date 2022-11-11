<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Products\Images;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ImagesController extends Controller
{
    public function create(Request $request,$id)
    {
        $prod = Products::findOrFail($id);
        return view('admin.product.image.create',compact('prod'));
       
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:5242880',  //5MB = 5242880 KB
            'product_id'=>'required|numeric',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $img = new Images();
            $img->product_id = $request->product_id;
    
            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('uploads/ecommerce/product/', $filename);
                $img->image = $filename;
            }
            $img->save();
            return redirect()->route('admin.products.show',$request->product_id)->with('status','Image Aded Successfully');
        }
    }

    public function edit($id,$id2)
    {
        $prod = Products::findOrFail($id2);
        $img = Images::findOrFail($id);
        return view('admin.product.image.edit',compact('img','prod'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:5242880',  //5MB = 5242880 KB
            'product_id'=>'required|numeric',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $img = Images::findOrFail($id);
            $img->product_id = $request->product_id;
    
            if($request->hasfile('image'))
            {
                $destination = 'uploads/ecommerce/product/'.$img->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('uploads/ecommerce/product/', $filename);
                $img->image = $filename;
            }
            $img->update();
            return redirect()->route('admin.products.show',$request->product_id)->with('status','Image Edited Successfully');
        }
    }

    public function destroy($id)
    {
        $prod = Images::findOrFail($id);
        $destination = 'uploads/ecommerce/product/'.$prod->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
        $prod->delete();
        return back()->with('success','Image Deleted Successfully');
    }

}
