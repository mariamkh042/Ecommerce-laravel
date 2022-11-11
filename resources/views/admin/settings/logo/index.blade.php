@extends('layouts.admin.admin')
@section('title','Logo')
@section('header','Settings / Logo')
@section ('header-title','Logo')

@section('content')

    <!-- Main content -->
    <div class="hold-transition register-page">
  
        <div class="register-box">
          <div class="register-logo">
               @if($logo->count() < 1)
               <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <br>
                    <h3> Add Logo First </h3>
                  </div>
                  <br>
                  <a href="{{url('admin/settings/logo/create')}}" class="btn btn-primary text-white">Add</a>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              @else
               <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="img-fluid"
                    @foreach ($logo as $item)
                        
                         src="{{asset('uploads/ecommerce/Logo/'.$item['logo'])}}"
                         alt="Logo">
                  </div>
                  <br>
                  <a href="{{url('admin/settings/logo/'.$item['id'].'/edit')}}" class="btn btn-primary text-white">Edit</a>
                  @endforeach
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              @endif
          </div>
        </div>
    </div>
        
@endsection

