<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function admins()
    {
        $admins = User::where('role_as','1')->get();
        return view('admin.users.admins',compact('admins'));
    }

    public function users()
    {
        $users = User::where('role_as','0')->get();
        return view('admin.users.user',compact('users'));
    }
    
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.users.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','min:3','max:191'],
            'mobile' => ['required','numeric','digits:11'],
            'phone' => ['nullable','numeric'],
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5242880',
            'role_as'=>'required|numeric|digits:1',
        ]);

        //delete image when it become normal user
        if($request->role_as == 0){
            $destination = 'uploads/admin/users/'.$user->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $user->image = Null; 
        }

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
            $user->role_as = $request->role_as;
            $user->password =  Hash::make($request['password']);
            $user->update();
            return redirect('/admin/admins')->with('status','User Edited Successfully');
        }
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','min:3','max:191'],
            'mobile' => ['required','numeric','digits:11'],
            'phone' => ['nullable','numeric'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'role_as'=>'required|numeric|digits:1',
            'image' =>['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:5242880'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
           $user = new User();
           $user->name = $request->name;
           $user->mobile = $request->input('mobile');
           $user->phone = $request->input('phone');
           $user->email = $request->email;
           $user->role_as = $request->role_as;
           $user->password =  Hash::make($request['password']);
           if($request->hasfile('image'))
           {
               $file = $request->file('image');
               $extention = $file->getClientOriginalExtension();
               $filename = time().'.'.$request->name.'.'.$extention;
               $file->move('uploads/admin/users/', $filename);
               $user->image = $filename;
   
           }
           $user->save();
           return redirect('/admin/admins')->with('status','User Registered Successfully');


        }
    }
}
