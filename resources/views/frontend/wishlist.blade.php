@extends('layouts.frontend.front')

@section('title','My Wishlist')

@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li class="active"><a href="{{url('/')}}">Home</a></li>
                    <li class="active">My Wishlist</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
<div class="container">
    <div class="card">
        <div class="card-body">
            @if($wishlist->count() > 0)
                <br> <br> <br>
                @foreach($wishlist as $item)
                <div class="row wishData">
                    <div class="col-md-2">
                        <a href="{{url('category/'.$item->products->category->slug.'/'.$item->products->slug)}}">
                            <img src="{{asset('uploads/ecommerce/product/'.$item->products->image)}}" class="cart-image" alt="Image">
                        </a>
                    </div>
        
                    <div class="col-md-2">
                        <br>
                        <h5> {{$item->products->name}} </h5>
                    </div>
    
                    <div class="col-md-2">
                        <br>
                        <h6> {{$item->products->total_price}} L.E </h6>
                    </div>
        
                    <div class="col-md-2">
                        <div class="product-details">
                            <div class="add-to-cart">
                                <input type="hidden" value="{{$item->products->id}}" class="prod_id"> 
                                <input type="hidden" class="prod_token" value="{{ csrf_token() }}">
                                <br>
                                @if($item->products->total_quantity($item->products->id) > $item->product_qty)
                                  <h6 style="color:green"> In stock </h6>
                                 @else
                                 <label>
                                 <h6 style="color:red"> Out of stock </h6>
                                 </label>
                                 @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <br>
                        <form action="{{url('add-to-cart')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$item->products->id}}">
                            <input type="hidden" name="product_qty" value="1">
                            @php
                             foreach($item->products->color as $color){
                                $prodColor = $color->name;
                             }
                             @endphp
                            <input type="hidden" name="color" value="{{$prodColor}}">
                            <button class="btn btn-primary" style="background-color:lightred"><i class="fa fa-shopping-cart"> Add to cart </i></button>
                        </form>
                    </div>

                    <div class="col-md-2">
                        <br>
                        <input type="hidden" class="product_name_input" value="{{$item->products->name}}">
                        <button class="btn btn-danger wishDelete"><i class="fa fa-trash"> Remove </i></button>
                    </div>
                </div>
                @endforeach
    
            @else
            <br> <br> <br>
            <div style="text-align: center">
                <h4> There are no products in your wishlist</h4>
                <a href="{{url('category')}}" class="primary-btn order-submit"> Continue Shopping </a>
                <br> <br> <br>
            </div>
          
            @endif
        </div>
    </div>
</div>
@endsection

@push('script')
{{-- Delete Cart --}}
<script>
    $('.wishDelete').click(function (e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var prod_id = $(this).closest('.wishData').find('.prod_id').val();
        var prod_name = $(this).closest('.wishData').find('.product_name_input').val();
        var prod_token = $(this).closest('.wishData').find('.prod_token').val();

        $.ajax({
            type: "DELETE",
            url: "/delete-wishlist",
            data: {
                'prod_id' : prod_id,
                'prod_name' : prod_name,
                '_token' : prod_token
            },
            success: function(response) {
                window.location.reload();
                Swal.fire({
                    icon: 'success',
                    title: response.status,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            });

    });
</script>
@endpush
