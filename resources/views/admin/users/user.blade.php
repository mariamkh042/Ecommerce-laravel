@extends('layouts.admin.admin')

@push('css')
@include('inc.dataTable.dataTableCss')
@endpush

@section('title','Users')

@section('header-title','Users Page')

@section('header','Users Page')
@section('content')
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Table Of All Users Registered</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong>Number Of Users are : </strong> {{$users->count()}}
          <br>
          <br>
  
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile Phone</th>
              <th>Home Phone</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
            <tr>
              <input type="hidden" class="delete_val_id" value="{{$user->id}}">
              <input type="hidden" class="delete_val_name" value="{{$user->name}}">
              <input type="hidden" class="delete_val_token" value="{{ csrf_token() }}">
  
              <td><strong> {{$loop->iteration}} </strong></td>
              <td>{{$user['name']}}</td>
              <td>{{$user['email']}}</td>
              <td>{{$user['mobile']}}</td>
              <td>
                @if($user->phone)
                {{$user['phone']}}
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
