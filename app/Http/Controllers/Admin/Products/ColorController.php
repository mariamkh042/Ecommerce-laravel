<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Products\Colors;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function create(Request $request,$id)
    {
        $prod = Products::findOrFail($id);
        return view('admin.product.color.create',compact('prod'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'product_id'=>'required|numeric',
            'name'=>'required|min:3|max:191',
            'qty'=>'required|numeric',
            'color'=>'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $color = new Colors();
            $color->product_id = $request->product_id;
            $color->name = $request->name;
            $color->color = $request->color;
            $color->qty = $request->qty;
            $color->save();
            return redirect()->route('admin.products.show',$request->product_id)->with('status','Color Added Successfully');
        }
    }

    public function edit($id,$id2)
    {
        $prod = Products::findOrFail($id2);
        $color = Colors::findOrFail($id);
        return view('admin.product.color.edit',compact('prod','color'));
    }

    public function update(Request $request, $id)
    {
        $color = Colors::findOrFail($id);

        $validator = Validator::make($request->all() , [
            'product_id'=>'required|numeric',
            'name'=>['required','min:3','max:191'],
            'qty'=>'required|numeric',
            'color'=>['required'],
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $color->product_id = $request->product_id;
            $color->name = $request->name;
            $color->color = $request->color;
            $color->qty = $request->qty;
            $color->update();
            return redirect()->route('admin.products.show',$request->product_id)->with('status','Color Edited Successfully');
        }

    }

    public function destroy($id)
    {
        $color = Colors::findOrFail($id);
        $color->delete();
        return back()->with('status','Color Deleted Successfully');
    }

}
