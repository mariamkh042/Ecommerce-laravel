@extends('layouts.frontend.front')

@section('title','View Product')

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
                    <li class="active"><a href="{{url('category/'.$category->slug)}}">{{$category->name}}</a></li>
                    <li class="active">{{$products->name}}</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
	<!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="{{asset('uploads/ecommerce/product/'.$products->image)}}" alt="">
                        </div>

                        @if($prod_img->count() > 0)
                        @foreach($prod_img as $img)
                        <div class="product-preview">
                            <img src="{{asset('uploads/ecommerce/product/'.$img->image)}}" alt="">
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="{{asset('uploads/ecommerce/product/'.$products->image)}}" alt="">
                        </div>
                        
                        @if($prod_img->count() > 0)
                        @foreach($prod_img as $img)
                        <div class="product-preview">
                            <img src="{{asset('uploads/ecommerce/product/'.$img->image)}}" alt="">
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">
                            {{$products->name}}
                            @if($products->trending == 1)
                            <span class="product-available">Trending</span>
                            @endif
                        </h2>
                        <div>
                            <h3 class="product-price">{{$products->total_price}} L.E</h3>
                            @if($products->offer > 0)
                            <del class="product-old-price">{{$products->selling_price}} L.E</del>
                            @if($products->tax > 0)
                            <p> But there is tax by {{$products->tax}}% </p>
                            @endif
                            @endif
                        </div>
                        <p>{{$products->small_description}}.</p>

                        <form action="{{url('add-to-cart')}}" method="POST">
                            @csrf
                        <input type="hidden" name="product_id" value="{{$products->id}}">
                        <div class="product-options">
                            <div class="add-to-cart">
                                @if($products->total_quantity($products->id) > 0)
                                <span class="badge bg-success" style="background-color:green"> In Stock </span>
                                @else
                                <span class="badge bg-danger" style="background-color:rgb(182, 0, 0)"> Out of Stock </span>
                                @endif
                                <br><br>
                                <div class="qty-label">
                                    <label> Qty </label>
                                    <div class="input-number">
                                        <input type="number" name="product_qty" value="1" min="1" max="{{$products->total_quantity($products->id)}}">
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                </div>
                            </div>
                            <label>
                                Color
                                <select class="input-select" name="color">
                                    @foreach($prod_color as $color)
                                    <option value="{{$color->name}}">{{$color->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>

                        <div class="add-to-cart">
                            <ul class="product-btns">
                                @if($products->total_quantity($products->id) > 0)
                                <li><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button></li>
                                @endif
                                </form>
                                <br><br>
                                <form action="{{url('add-to-wishlist')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$products->id}}">
                                    <li><button class="add-to-cart-btn"><i class="fa fa-heart-o"></i> add to wishlist</button></li>
                                </form>
                            </ul>
                        </div>

                        <ul class="product-links">
                            <li>Category:</li>
                            <li><a href="{{url('category/'.$category->slug)}}">{{$category->name}}</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /Product details -->
            </div>

            <div class="row">
                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                            <li><a data-toggle="tab" href="#tab2">Details</a></li>
                            <li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{{$products->description}}.</p><br>
                                        <p>{{$products->small_description}}.</p><br>
                                        <p>{{$products->meta_description}}.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->

                            <!-- tab2  -->
                            <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Colors Availabe:</p><br>
                                        @if($prod_color->count() > 0)
                                        @foreach($prod_color as $item)
                                        <div class="btn btn-default text-center">
                                            {{$item->name}}<br>
                                            <i class="fa fa-circle fa-2x" style="color:{{$item['color']}};"></i>
                                        </div>
                                        @endforeach
                                        @else 
                                        Not Availabe
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /tab2  -->

                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection