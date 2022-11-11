@extends('layouts.admin.admin')

@section('title','Orders')
@push('css')
<style>
.input {
  height: 40px;
  padding: 0px 15px;
  border: 1px solid #E4E7ED;
  background-color: #FFF;
  width: 100%;
}

textarea.input {
  padding: 15px;
  min-height: 90px;
}
</style>
@endpush
@section('more-header')
<li class="breadcrumb-item"><a href="{{url('admin/orders')}}">Orders</a></li>
@endsection

@section('header-title','View Order')

@section('header','View Order')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Order View</h3>
            <a href="{{url('admin/orders')}}" class="btn btn-warning" style="float:right; color:black;"> Back </a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <!-- Billing Details -->
                    <h3>Billing address</h3>
                    <hr>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input class="input" value="{{$order->name}}" disabled>
                    </div>
    
                    <div class="form-group">
                        <label for="">Email</label>
                        <input class="input" value="{{Auth::user()->email}}" disabled>
                    </div>
                
                    <div class="form-group">
                        <label for="">Mobile Phone</label>
                        <input class="input" value="{{$order->mobile}}" disabled>
                    </div>
                  
                    <div class="form-group">
                        <label for="">Home Phone</label>
                        <input class="input" value="{{$order->phone == NULL ? 'Not added':$order->phone}}" disabled>
                    </div>
    
                    <div class="form-group">
                        <label for="">Country</label>
                        <input class="input" type="text" value="Egypt" disabled>
                    </div>
                
                    <div class="form-group">
                        <label for="">City</label>
                        <input class="input" value="{{$order->city}}" disabled>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Address</label>
                        <input class="input" value="{{$order->address}}" disabled>
                    </div>
                  
                    <div class="form-group">
                        <label for="">Pin Code</label>
                        <input class="input" value="{{$order->pin_code}}" disabled>
                    </div>
                    <!-- /Billing Details -->
                    @if ($order->note !=NULL)
                    <!-- Order notes -->
                    <div class="order-notes">
                        <label for="">Nore</label>
                        <textarea class="input" disabled>{{$order->note}}</textarea>
                    </div>
                    <!-- /Order notes -->
                    @endif
                </div>
    
                <div class="col-md-6">
                    <h3>Order Details</h3>
                    <hr>
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                              <th>Name</th>
                              <th>Quantity</th>
                              <th>Color</th>
                              <th>Price</th>
                              <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderProducts as $item)
                            <tr>
                                <td> {{$item->products->name}} </td>
                                <td> {{$item->qty}} </td>
                                <td> {{$item->color}} </td>
                                <td> {{$item->price}} </td>
                                <td> <img src="{{asset('uploads/ecommerce/product/'.$item->products->image)}}" class="profile-user-img"> </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <br>
                      <h4> Grand Total : <span style="float:right">{{$order->total_price}} L.E</span></h4>
                      <div class="mt-5 px-2">
                          <label> Order Status</label>
                          <form action="{{url('admin/update-order/'.$order->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                              <select class="form-control" name="status">
                                  <option value="0" {{$order->status=='0'?'selected':''}}>Pending</option>
                                  <option value="1" {{$order->status=='1'?'selected':''}}>Completed</option>
                              </select>
                              @error('status')
                              <span class="text-red" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <button type="submit" class="btn btn-primary mt-3" style="float:right"> Update </button>
                          </form>
                      </div>
                </div>
            </div>
         
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
