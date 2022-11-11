<?php

namespace App\Http\Controllers\Admin\settings;

use App\Models\Info;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Info::all();
        return view('admin.settings.info.index',compact('data'));
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
        $data = Info::findOrFail($id);
        return view('admin.settings.info.edit',compact('data'));
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
        $data = Info::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name'=>'required|string|min:3|max:255',
            'email'=>'required|email|max:255',
            'phone'=>'required|numeric|digits:11',
            'facebook'=>'required|url|max:300',
            'youtube'=>'required|url|max:300',
            'instagram'=>'required|url|max:300',
            'twitter'=>'required|url|max:300',
            'location'=>'required|min:3',
            'open_hours'=>'required|min:3',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->phone = $request->input('phone');
            $data->facebook = $request->input('facebook');
            $data->youtube = $request->input('youtube');
            $data->instagram = $request->input('instagram');
            $data->twitter = $request->input('twitter');
            $data->location = $request->input('location');
            $data->open_hours = $request->input('open_hours');
            $data->update();
            return redirect('admin/settings/info')->with('status','Information website Edited Successfully');
        }
    }

}
