@extends('layouts.frontend.front')

@section('title','Category')

@section('content')

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Categories</h3>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tabNewCat" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-NewCat">
                                @foreach($new_cat as $cat)
                                @if($cat->status == 1)
                                <!-- product -->
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{asset('uploads/ecommerce/category/'.$cat->image)}}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href="{{url('category/'.$cat->slug)}}">{{$cat->name}}</a></h3>
                                        <h4 class="product-name">{{$cat->description}}</h4>
                                    </div>
                                    <div class="add-to-cart">
                                        <form action="{{url('category/'.$cat->slug)}}">
                                        <button class="add-to-cart-btn"><i class="fa fa-eye"></i> Show Products</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /product -->
                                @endif
                                @endforeach
                            </div>
                            <div id="slick-nav-NewCat" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Featured Categories</h3>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tabPopularCat" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-PopularCat">
                                @foreach($popular_cat as $cat)
                                @if($cat->popular == 1)
                                <!-- product -->
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{asset('uploads/ecommerce/category/'.$cat->image)}}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href="{{url('category/'.$cat->slug)}}">{{$cat->name}}</a></h3>
                                        <h4 class="product-name">{{$cat->description}}</h4>
                                    </div>
                                    <div class="add-to-cart">
                                        <form action="{{url('category/'.$cat->slug)}}">
                                        <button class="add-to-cart-btn"><i class="fa fa-eye"></i> Show Products</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /product -->
                                @endif
                                @endforeach
                            </div>
                            <div id="slick-nav-PopularCat" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">All Categories</h3>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tabCat" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-Cat">
                                @foreach($category as $cat)
                                <!-- product -->
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{asset('uploads/ecommerce/category/'.$cat->image)}}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href="{{url('category/'.$cat->slug)}}">{{$cat->name}}</a></h3>
                                        <h4 class="product-name">{{$cat->description}}</h4>
                                    </div>
                                    <div class="add-to-cart">
                                        <form action="{{url('category/'.$cat->slug)}}">
                                        <button class="add-to-cart-btn"><i class="fa fa-eye"></i> Show Products</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /product -->
                                @endforeach
                            </div>
                            <div id="slick-nav-Cat" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->



@endsection