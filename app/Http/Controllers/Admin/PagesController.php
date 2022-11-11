<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pages::all();
        return view('admin.pages.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
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
            'title' => 'required|min:3|max:191|unique:pages',
            'slug' => 'required|min:3|max:191|unique:pages',
            'description' => 'required|min:3'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
   
            $description = $request->description;
            $dom = new \DomDocument();
            @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
            $images = $dom->getElementsByTagName('img');
            foreach($images as $k => $img){
                $data = $img->getAttribute('src');
      
                list($type, $data) = explode(';', $data);
      
                list(, $data)      = explode(',', $data);
      
                $data = base64_decode($data);
      
                $image_name= "/uploads/ecommerce/pages/" .time().$k.'.png';
      
                $path = public_path() . $image_name;
       
                file_put_contents($path, $data);
      
                $img->removeAttribute('src');
      
                $img->setAttribute('src', $image_name);
             }
      
             $description = $dom->saveHTML();
             $summernote = new Pages();
             $summernote->title = $request->title;
             $summernote->slug = $request->slug;
             $summernote->description = $description;
             $summernote->save();
             return redirect('admin/pages')->with('status','Page Added Successfully');
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
        $data = Pages::findOrFail($id);
        return view('admin.pages.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pages::findOrFail($id);
        return view('admin.pages.edit',compact('data'));
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
        $summernote = Pages::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:3|max:191|unique:pages',
            'slug' => 'required|min:3|max:191|unique:pages',
            'description' => 'required|min:3'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $dom = new \DomDocument();
            $description_old = $summernote->description;
            @$dom->loadHtml($description_old, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
            $images_old = $dom->getElementsByTagName('img');
            foreach($images_old as $k => $img_old){
                $data_old[] = $img_old->getAttribute('src');
             }
     
            $description = $request->description;
            @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
            $images = $dom->getElementsByTagName('img');
            foreach($images as $k => $img){
                $data = $img->getAttribute('src');
                $test = strpos($data,';');
                if($test != false){
                 list($type, $data) = explode(';', $data);
                 list(, $data)      = explode(',', $data);
                 $data = base64_decode($data);
                 $image_name= "/uploads/ecommerce/pages/" .time().$k.'.png';
                 $path = public_path() . $image_name;
                 file_put_contents($path, $data);
                 $img->removeAttribute('src');
                 $img->setAttribute('src', $image_name);
                }else{
                 $img->removeAttribute('src');
                 $img->setAttribute('src', $data);
                 $data_new [] = $data;
                }
          
             }
             if(isset($data_new)){
                 $result=array_diff($data_old,$data_new);
                 foreach ($result as $key => $unwanted_path) {
                     $unwanted_path.'<br>';
                     $unwanted_path = substr($unwanted_path,1);
                     self::fileExists($unwanted_path);
                      if(File::exists($unwanted_path))
                     {
                         File::delete($unwanted_path);
                     }
                 }
             }else{
                 if(isset($data_old)){
                 foreach($data_old as $key => $unwanted_path){
                         $unwanted_path.'<br>';
                         $unwanted_path = substr($unwanted_path,1);
                         if(File::exists($unwanted_path))
                         {
                             File::delete($unwanted_path);
                         }
                 }
                 }
     
             }
             $description = $dom->saveHTML();
             $summernote->title = $request->title;
             $summernote->slug = $request->slug;
             $summernote->description = $description;
             $summernote->update();
             return redirect()->route('admin.pages.index')->with('status','Page Edited Successfully');
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
        $page = Pages::findOrFail($id);
        $description = $page->description;
        $dom = new \DomDocument();
        @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            $path = substr($data,1);
            if(File::exists($path))
            {
                File::delete($path);
            }
         }
        $page->delete();
        return back()->with('status','Page Deleted Successfully');
    }
}
