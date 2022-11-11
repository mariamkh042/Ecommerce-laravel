@extends('layouts.admin.admin')
@section('title','Add Category')
@section('header-title','Add Category Page')
@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/categories')}}">Category</a></li>
@endsection

@section('header','Add Category')
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
            
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">Add Category</h4>
        </div>

        <div class="card-body">
            <form action="{{url('admin/categories')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                        @if($errors->has('name'))
                        <span class="text-red" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" name="slug" class="form-control">
                        @if($errors->has('slug'))
                        <span class="text-red" role="alert">
                            <strong>{{ $errors->first('slug') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-md-12 mb-3">
                        <label> Description </label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                        @error('description')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Status : New</label>
                        <input type="checkbox" name="status">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Popular</label>
                        <input type="checkbox" name="popular">
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label> Meta Title </label>
                        <input type="text" name="meta_title" class="form-control">
                        @error('meta_title')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label> Meta Keywords </label>
                        <textarea name="meta_keywords" class="form-control" rows="3"></textarea>
                        @error('meta_keywords')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label> Meta Description </label>
                        <textarea name="meta_descrip" class="form-control" rows="3"></textarea>
                        @error('meta_descrip')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    
                    <div class="col-md-6 mb-3">
                        <label>Category Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                          </div>
                        </div>
                        @error('image')
                        <span class="text-red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary"> Add Category </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
      </div>
    </div>
</div>

@endsection
