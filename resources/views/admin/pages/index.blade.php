@extends('layouts.admin.admin')

@push('css')
@include('inc.dataTable.dataTableCss')
@endpush

@section('title','Pages')

@section('header-title','Pages')

@section('header','Pages')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-primary">
            <div class="info-box-content">
                <a href="{{url('admin/pages/create')}}" type="button" class="btn btn-block btn-primary btn-lg"> <i class="fas fa-plus-circle"></i> Add page </a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">DataTable of All Pages</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong>Number Of Pages are : </strong> {{$data->count()}}
            <br>
            <br>
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>#</th>
                <th>Name of pages</th>
                <th>Show</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
              </thead>
              <tbody>
                @foreach($data as $page)
              <tr>
                <td><strong> {{$loop->iteration}} </strong></td>
                <td>{{$page['title']}}</td>
                <td>
                  <a href="{{url('admin/pages/'.$page['id'])}}"><i class="fas fa-eye text-success fa-lg"></i></a>
                </td>
                <td>
                    <a href="{{url('admin/pages/'.$page['id'].'/edit')}}"> <i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a href="">  <i class="fas fa-trash text-danger fa-lg"></i></a>
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
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@push('script')
@include('inc.dataTable.dataTableFooter')
@endpush