@extends('layouts.frontend.front')

@section('title','View Category')

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
                    <h3 class="title">{{$category->name}}</h3>
                </div>
            </div>
            
            <div class="row">
                @foreach ($products as $prod)
                <div class="col-md-3">
                    <a class="quick-view" href="{{url('category/'.$category->slug.'/'.$prod->slug)}}">
                    <div class="product">
                        <div class="product-img">
                            <img src="{{asset('uploads/ecommerce/product/'.$prod->image)}}" alt="">
                            <div class="product-label">
                                @if($prod->offer > 0)
                                <span class="sale">{{$prod->offer}}%</span>
                                @endif
                                @if($prod->status == 1)
                                <span class="new">NEW</span>
                                @endif
                            </div>
                        </div>
                        <div class="product-body">
                            <h3 class="product-name"><a href="#">{{$prod->name}}</a></h3>
                            <h5 class="product-name">{{$prod->small_description}}</h5>
                            <h4 class="product-price">{{$prod->total_price}} L.E 
                                @if($prod->offer > 0)
                            </h4>
                            @if($prod->tax > 0)
                                <br>
                                <p>But there is tax by {{$prod->tax}}%</p>
                                @endif
                                @endif
                                <br>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection