@extends('layouts.frontend.front')
@push('css')
    <style>
        table{
            border: 1px black solid;
            width: 100%;
        }

        th{
            border: 1px black solid;
            padding: 10px;
        }

        td{
            border: 1px black solid;
            padding: 10px;
            text-align: center;
        }

        tr:hover {
            background-color: lightgray;
        }


    </style>
@endpush
@section('title','View Orders')

@section('content')
<a class="primary-btn" href="{{url('my-orders')}}"> Back </a>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Billing Details -->
            <div class="billing-details">
                <div class="section-title">
                    <h3 class="title">Billing address</h3>
                </div>
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
        </div>
        <div class="col-md-6">
            <div class="section-title">
                <h3 class="title">Order Details</h3>
            </div>
            <hr>
            <table>
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
                        <td> <img src="{{asset('uploads/ecommerce/product/'.$item->products->image)}}" class="cart-image"> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <h4> Grand Total : <span class="pull-right">{{$order->total_price}} L.E</span></h4>
        </div>
    </div>
</div>
@endsection