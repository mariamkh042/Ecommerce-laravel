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
@section('title','My Orders')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br> <br>
            <h1> My Orders </h1> <br>
            <table>
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
                    @foreach ($orders as $item)
                    <tr>
                      <td>{{ date('d-m-y',strtotime($item->ordered_at)) }}</td>
                      <td>{{$item->tracking_no}}</td>
                      <td>{{$item->total_price}} L.E</td>
                      <td>{{$item->status == '0' ? 'Pending':'Completed'}}</td>
                      <td><a href="{{url('view-order/'.$item->id)}}" class="btn btn-primary" style="background-color:#D10024"> <i class="fa fa-eye"></i> view </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection