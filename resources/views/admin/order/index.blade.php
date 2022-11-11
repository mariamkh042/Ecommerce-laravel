@extends('layouts.admin.admin')

@push('css')
@include('inc.dataTable.dataTableCss')
@endpush

@section('title','Orders')

@section('header-title','Orders Page')

@section('header','Orders Page')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">New Orders</h3>
            <a href="{{url('admin/order-history')}}" class="btn btn-warning" style="float:right"> Orders History </a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong>Number Of orders are : </strong> {{$orders->count()}}
            <br>
            <br>

            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Order Date</th>
                <th>Tracking Number</th>
                <th>Total price</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($orders as $item)
                <tr>
                    <td>{{ date('d-m-y',strtotime($item->ordered_at)) }}</td>
                    <td>{{$item->tracking_no}}</td>
                    <td>{{$item->total_price}} L.E</td>
                    <td>{{$item->status == '0' ? 'Pending':'Completed'}}</td>
                    <td><a href="{{url('admin/view-order/'.$item->id)}}" class="btn btn-primary"> <i class="fa fa-eye"></i> view </a></td>
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
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
@push('script')
@include('inc.dataTable.dataTableFooter')
@endpush