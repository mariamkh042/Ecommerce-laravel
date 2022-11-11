<?php

namespace App\Http\Controllers\Admin;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products\Colors;
use App\Models\Products\Images;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  = Categories::all();
        return view('admin.category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
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
            'name'=>'required|min:3|max:50|unique:categories',
            'slug'=>'required|alpha_dash|min:3|max:50|unique:categories',
            'description'=>'required|min:3',
            'meta_title'=>'nullable|min:3|max:255',
            'meta_descrip'=>'nullable|min:3',
            'meta_keywords'=>'nullable|min:3',
            'image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:5242880',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $category = new Categories();

            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().$request->slug.$extention;
                $file->move('uploads/ecommerce/category/', $filename);
                $category->image = $filename;
            }

            $category->name = $request->input('name');
            $category->slug = $request->input('slug');
            $category->description = $request->input('description');
            $category->status = $request->input('status') == True ? '1':'0';
            $category->popular = $request->input('popular') == True ? '1':'0';
            $category->meta_title = $request->input('meta_title');
            $category->meta_descrip = $request->input('meta_descrip');
            $category->meta_keywords = $request->input('meta_keywords');
            $category->save();
            
            return redirect('/admin/categories')->with('status','Category Added Successfully');
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
        $cat = Categories::findOrFail($id);
        return view('admin.category.show',compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.category.edit',compact('category'));
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
        $category = Categories::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name'=>['required','min:3','max:50',Rule::unique('categories')->ignore($category->id,'id')],
            'slug'=>['required','alpha_dash','min:3','max:50',Rule::unique('categories')->ignore($category->id,'id')],
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5242880',
            'description'=>['required','min:3'],
            'meta_title'=>'nullable|min:3|max:255',
            'meta_descrip'=>'nullable|min:3',
            'meta_keywords'=>'nullable|min:3',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            if($request->hasfile('image'))
            {
                $destination = 'uploads/ecommerce/category/'.$category->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().$request->slug.$extention;
                $file->move('uploads/ecommerce/category/', $filename);
                $category->image = $filename;
            }
            $category->name = $request->input('name');
            $category->slug = $request->input('slug');
            $category->description = $request->input('description');
            $category->status = $request->input('status') == True ? '1':'0';
            $category->popular = $request->input('popular') == True ? '1':'0';
            $category->meta_title = $request->input('meta_title');
            $category->meta_descrip = $request->input('meta_descrip');
            $category->meta_keywords = $request->input('meta_keywords');
            $category->update();
            
            return redirect('/admin/categories')->with('status','Category Editted Successfully');
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
        $cat = Categories::findOrFail($id);
        $prod = Products::where('category_id',$id)->get();
        if(isset($prod)){
            foreach ($prod as $data) {
                $destination = 'uploads/ecommerce/product/'.$data->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $img = Images::where('product_id', $data->id)->get();
                if(isset($img)){
                    foreach ($img as $image) {
                        $destination = 'uploads/ecommerce/product/'.$image->image;
                        if(File::exists($destination))
                        {
                            File::delete($destination);
                        }
                    }
                }
                Colors::where('product_id', $data->id)->delete();
                Images::where('product_id', $data->id)->delete();
            }
            Products::where('category_id',$id)->delete();
        }
        $destination = 'uploads/ecommerce/category/'.$cat->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }   
        $cat->delete();
        return response()->json(['status'=>'Category '.$cat->name. ' deleted successfully']);
    }
}
