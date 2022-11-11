<?php

namespace App\Http\Controllers\Admin\settings;

use App\Models\Logo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logo = Logo::all();
        return view('admin.settings.logo.index',compact('logo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Logo::count() == 0){
            return view('admin.settings.logo.create');
        }else{
            return abort(404);
        }
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
            'logo' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:5242880',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $img = new Logo();
            if($request->hasfile('logo'))
            {
                $file = $request->file('logo');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('uploads/ecommerce/Logo/', $filename);
                $img->logo = $filename;
            }
            $img->save();
        }
       
        return redirect('admin/settings/logo')->with('status','Logo added successfully');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logo = Logo::findOrFail($id);
        return view('admin.settings.logo.edit',compact('logo'));
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
        $validator = Validator::make($request->all(),[
            'logo' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:5242880',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $img = Logo::findOrFail($id);

        if($request->hasfile('logo'))
        {
            $destination = 'uploads/ecommerce/Logo/'.$img->logo;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('logo');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/ecommerce/Logo/', $filename);
            $img->logo = $filename;
        }
        $img->update();
        return redirect('admin/settings/logo')->with('status','Logo Editted Successfully');
        }
    }
}
