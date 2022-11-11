@extends('layouts.admin.admin')

@section('title','Edit My Info')

@section('header-title','Edit My Information')

@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/users/myInfo')}}">My Information</a></li>
@endsection
@section('header','Edit My Info')
@section('content')

<div class="hold-transition register-page">
    <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Edit Me</p>
      
          <form method="POST" action="{{ url('admin/users/myInfo/'.$data->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
      
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="name" type="text" name="name" value="{{$data->name}}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            @error('name')
            <span class="text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            <br>
            @enderror
      
            @if($data->image)
                <img src="{{asset('uploads/admin/users/'.$data->image)}}" alt="My Photo">
            @endif
            <div class="form-group">
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">Upload picture <small>*Not Required*</small></label>
                </div>
              </div>
          </div>
          @error('image')
          <span class="text-red" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
      
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="mobile" value="{{$data->mobile}}"  placeholder="Mobile *Required*">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <svg width="16" height="16" fill="black">
                      <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                  </div>
                </div>
            </div>
            @error('mobile')
            <span class="text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
      
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="phone" id="phone" value="{{$data->phone}}"  placeholder="Home Phone *Not Reqtuird* "> 
                <div class="input-group-append">
                    <div class="input-group-text">
                          <svg width="16" height="16" fill="black">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                          </svg>
                    </div>
                </div>
            </div>
            @error('phone')
            <span class="text-red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
      
            <div class="input-group mb-3">
              <input type="email" class="form-control"  value="{{$data->email}}" disabled>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            </div>
           
            <div class="row">
                <div class="col-6"> 
                    <button type="submit" class="btn btn-primary">Edit My Info</button>
                </div>
                <div class="col-3"> 
                </div>
                <div class="col-3"> 
                    <a type="submit" href='{{url('admin/users/myInfo')}}' class="btn btn-default float-right">Cancel</a>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
    
      @endsection