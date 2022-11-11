<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MyInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.myInfo.index');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
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
        $data = User::findOrFail($id);
        return view('admin.users.myInfo.edit',compact('data'));
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
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','min:3','max:191'],
            'mobile' => ['required','numeric','digits:11'],
            'phone' => ['nullable','numeric'],
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5242880',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            if($request->hasfile('image'))
            {
                $destination = 'uploads/admin/users/'.$user->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$request->name.'.'.$extention;
                $file->move('uploads/admin/users/', $filename);
                $user->image = $filename;
    
            }
            $user->name = $request->input('name');
            $user->mobile = $request->input('mobile');
            $user->phone = $request->input('phone');
            $user->update();
            return redirect('/admin/users/myInfo')->with('status','Your information edited successfully');
        }
       
    }

}
