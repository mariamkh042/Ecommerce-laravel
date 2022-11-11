@extends('layouts.frontend.front')

@section('title','My Cart')

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
                    <li class="active">My Cart</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

@if($cartItems->count() < 1)
<br>
<div class="container">
    <div class="card">
        <div class="card-body" style="text-align: center">
            <br> <br> <br>
            <h4> Your <i class="fa fa-shopping-cart"></i> Cart is empty </h4> <br>
            <a href="{{url('category')}}" class="primary-btn order-submit"> Continue Shopping </a>
            <br> <br> <br>
        </div>
    </div>
    
</div>
    
@else
<br>
<div class="container">
    <div class="card">
        <div class="card-body ">
            <br> <br> <br>
            @php $total = 0; @endphp
            @foreach($cartItems as $item)
            <div class="row cartData">
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
                    <h6> {{$item->products->total_price * $item->product_qty}} L.E </h6>
                </div>
    
                <div class="col-md-4">
                    <div class="product-details">
                        <div class="add-to-cart">
                            <input type="hidden" value="{{$item->products->id}}" class="prod_id"> 
                            <input type="hidden" class="prod_token" value="{{ csrf_token() }}">
                            <div class="qty-label">
                                <label>
                                    Color
                                    <select class="input-select" name="color" onchange="colorChange(this);">
                                        @foreach($item->products->color as $color)
                                        <option value="{{$color->name}}" {{ $item->color === $color->name ? "selected":"" }}>{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
                               @if($item->products->total_quantity($item->products->id) > $item->product_qty)
                                <label> Qty </label>
                                <div class="input-number">
                                    <input type="number" value="{{$item->product_qty}}" name="product_qty" class="qty_input" min="1" max="{{$item->products->total_quantity($item->products->id)}}">
                                    <span class="qty-up changeQty">+</span>
                                    <span class="qty-down changeQty">-</span>
                                </div>
                                @php $total += $item->products->total_price * $item->product_qty; @endphp
                                @else
                                <label>
                                <h6> Out of stock </h6>
                                </label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-2">
                    <input type="hidden" class="product_name_input" value="{{$item->products->name}}">
                    <button class="btn btn-danger cartDelete"><i class="fa fa-trash"> Remove </i></button>
                </div>
            </div>
            @endforeach

        </div>
        
        <div class="card-footer">
            <h6>
                Total Price : {{$total}} L.E
                
            </h6>
        </div>

        <div class="product-details">
            <div class="add-to-cart">
                <a class="primary-btn order-submit pull-right" href="{{url('checkout')}}">Proceed to Chechout</a>
            </div>
        </div>
        
    </div>
    
</div>
@endif

@endsection

@push('script')
{{-- Delete Cart --}}
<script>
    $('.cartDelete').click(function (e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var prod_id = $(this).closest('.cartData').find('.prod_id').val();
        var prod_name = $(this).closest('.cartData').find('.product_name_input').val();
        var prod_token = $(this).closest('.cartData').find('.prod_token').val();

        $.ajax({
            type: "DELETE",
            url: "/delete-cart",
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

{{-- Update Cart --}}
<script>
    //update qty
    $('.changeQty').click(function (e){
        var prod_id = $(this).closest('.cartData').find('.prod_id').val();
        var prod_qty = $(this).closest('.cartData').find('.qty_input').val();
        var prod_token = $(this).closest('.cartData').find('.prod_token').val();
    $.ajax({
            type: "POST",
            url: "/update-cart",
            data: {
                'prod_id' : prod_id,
                'prod_qty' : prod_qty,
                '_token' : prod_token
            },
            success: function(response) {
                window.location.reload();
            }
            });
    });
</script>

{{-- update color --}}
<script>
    function colorChange(color){
        var prod_color = color.value;
        // var prods_ids = $('input[type=hidden].prod_id').each(function() {
        //     var prod_id = $this.val();
        // }
        // var prod_id = document.getElementById('prod_id').value;
        // alert(prod_color);

        // $.ajax({
        // type: "POST",
        // url: "/update-cart",
        // data: {
        //     'prod_id' : prod_id,
        //     'prod_color' : prod_color,
        //     '_token' : prod_token
        // },
        // success: function(response) {
        //     window.location.reload();
        //     alert(response.status);
        // }
        // });
    };
</script>
@endpush
