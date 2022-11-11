@extends('layouts.admin.admin')
@section('title','Add Logo')

@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/settings/logo')}}">Logo</a></li>
@endsection

@section('header','Settings / Add Logo')

@section ('header-title','Add logo for the first time')

@section('content')

<div class="hold-transition register-page">
    <div class="register-box">                    
         <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Logo for the first time</h3>
            </div>
            <form method="POST" action="{{route('admin.logo.store')}}" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputFile">Logo Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="logo" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                      </div>
                    </div>
                </div>
                @error('logo')
                    <span class="text-red" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="Add">
                <a type="submit" href='{{url('admin/settings/logo')}}' class="btn btn-default float-right">Cancel</a>
              </div>
              <!-- /.card-footer -->
            </form>
         </div>
    </div>
</div>
        
@endsection

