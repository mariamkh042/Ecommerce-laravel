<?php

namespace App\Http\Controllers\Admin\settings;

use App\Models\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Questions::all();
        return view('admin.settings.FAQ.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.FAQ.create');
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
            'question'=>'required|min:3',
            'answer'=>'required|min:3',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $faq = new Questions();
            $faq->question = $request->input('question');
            $faq->answer = $request->input('answer');
            $faq->save();
        }
        return redirect('admin/settings/faq')->with('status','Question and answer added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Questions::findOrFail($id);
        return view('admin.settings.FAQ.edit',compact('data'));
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
            'question'=>'required|min:3|max:191',
            'answer'=>'required|min:3|max:191',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $faq = Questions::findOrFail($id);
            $faq->question = $request->input('question');
            $faq->answer = $request->input('answer');
            $faq->update();
            return redirect('admin/settings/faq')->with('status','Question and answer edited successfully');
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
        $q = Questions::findOrFail($id);
        $q->delete();
        return back()->with('status','Question and answer deleted successfully');
    }
}
