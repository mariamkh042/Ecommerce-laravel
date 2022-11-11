@extends('layouts.admin.admin')

@push('css')
@include('inc.dataTable.dataTableCss')
@endpush

@section('title','Admins')

@section('header-title','Admins Page')

@section('header','Admins Page')
@section('content')
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Table Of All Admins</h3>
          <a href="{{url('admin/users')}}" class="btn btn-warning" style="float:right"> Registered Users </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong>Number Of Users are : </strong> {{$admins->count()}}
          <br>
          <br>
  
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile Phone</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach($admins as $user)
            <tr>
              <input type="hidden" class="delete_val_id" value="{{$user->id}}">
              <input type="hidden" class="delete_val_name" value="{{$user->name}}">
              <input type="hidden" class="delete_val_token" value="{{ csrf_token() }}">
  
              <td><strong> {{$loop->iteration}} </strong></td>
              <td>{{$user['name']}}</td>
              <td>{{$user['email']}}</td>
              <td>{{$user['mobile']}}</td>
              <td>
                @if($user->image)
                <img src="{{asset('uploads/admin/users/'.$user->image)}}" class="profile-user-img">
                @else
                Not added
                @endif
              </td>
              <td>
                <a href="{{url('admin/users/'.$user['id'])}}" class="btn btn-primary"> <i class="fa fa-edit"></i>Edit</a>
              </td>
            </tr>
             @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</section>
@endsection

@push('script')
<!-- DataTables  & Plugins -->
@include('inc.dataTable.dataTableFooter')
@endpush
