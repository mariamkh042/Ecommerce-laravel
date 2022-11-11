@extends('layouts.admin.admin')

@section('title','My Information')

@section('header-title','My Information Page')

@section('header','My Info')
@section('content')

<div class="text-center">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-10">
                <!-- Profile Image -->
      <div class="card card-primary">
          <div class="card-header">
              <h3 class="card-title">About Me</h3>
          </div>
          <div class="card-body">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   @if(isset(Auth::user()->image))
                   src="{{asset('uploads/admin/users/'.Auth::user()->image)}}"
                   @else
                   src="{{asset('admin/dist')}}/img/user2-160x160.jpg"
                   @endif
                   alt="User profile picture">
            </div>
  
            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
  
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Name : </b> {{Auth::user()->name}}
              </li>
              <li class="list-group-item">
                <b>Email : </b>{{Auth::user()->email}}
              </li>
              <li class="list-group-item">
                <b>Mobile : </b> {{Auth::user()->mobile}}
              </li>
              <li class="list-group-item">
                <b>Phone : </b> 
                @if(isset(Auth::user()->phone))
                {{Auth::user()->phone}}
                @else
                Nothing to show
                @endif
              </li>
            </ul>
  
            <a href="{{url('admin/users/myInfo/'.Auth::user()->id.'/edit')}}" class="btn btn-primary"><b>Edit</b></a>
          </div>
          <!-- /.card-body -->
      </div>
          </div>
        </div>
      </div>
    </section>  
    </div>

@endsection