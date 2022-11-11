@extends('layouts.frontend.front')

@section('title','Home')

@push('css')
<style>
	.mySlides {display: none;}
	.cat_img {vertical-align: middle;}
	
	/* Slideshow container */
	.slideshow-container {
	  max-width: 1000px;
	  position: relative;
	  margin: auto;
	}
	
	
	/* Number text (1/3 etc) */
	.numbertext {
	  color: black;
	  font-size: 12px;
	  padding: 8px 12px;
	  position: absolute;
	  top: 0;
	}
	
	/* The dots/bullets/indicators */
	.dot {
	  height: 15px;
	  width: 15px;
	  margin: 0 2px;
	  background-color: #bbb;
	  border-radius: 50%;
	  display: inline-block;
	  transition: background-color 0.6s ease;
	}
	
	
	/* Fading animation */
	.fade {
	  animation-name: fade;
	  animation-duration: 1.5s;
	}
	
	@keyframes fade {
	  from {opacity: .4} 
	  to {opacity: 1}
	}
	
	/* On smaller screens, decrease text size */
	@media only screen and (max-width: 300px) {
	  .text {font-size: 11px}
	}
</style>
@endpush

@section('content')
{{-- Popular Categories --}}
	<!-- SECTION -->
	<div class="row">
		<div class="slideshow-container">
		@foreach($popular_cat as $cat)
		<div class="mySlides fade">
			<div class="numbertext">{{$loop->iteration}} / {{$popular_cat->count()}}</div>
			  <!-- shop -->
				<div class="shop">
					<div class="shop-img">
						<img src="{{asset('uploads/ecommerce/category/'.$cat->image)}}" class="cat_img" style="width:100%" alt="">
					</div>
					<div class="shop-body">
						<h3>{{$cat->name}}<br>Collection</h3>
						<p style="color: white"> {{$cat->description}} </p>
						<a href="{{url('category/'.$cat->slug)}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			<!-- /shop -->
		</div>
		@endforeach
		
		</div>
		<br>
		<div style="text-align:center">
		@foreach($popular_cat as $cat)
		  <span class="dot"></span> 
		@endforeach
		</div>
	</div>
    <!-- /SECTION -->


    {{-- New Products --}}
   <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">New Products</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab0">All</a></li>
									@foreach($new_products_category as $item)
									<li class="{{ $item->id == 1 ? 'active' : '' }}"><a data-toggle="tab" href="#tab{{ $item->id }}" aria-controls="home" role="tab">{{$item->name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								@foreach($new_products_category as $item)
								<div id="tab{{$item->id}}" class="tab-pane {{ $item->id == 1 ? 'active' : '' }}">
									<div class="products-slick" data-nav="#slick-nav-{{$item->id}}">
										@foreach($item->products as $prod)
										@if($prod->status == 1)
										<!-- product -->
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
												<p class="product-category"><a href="{{url('category/'.$prod->category->slug)}}">{{$prod->category->name}}</a></p>
												<h3 class="product-name"><a href="{{url('category/'.$prod->category->slug.'/'.$prod->slug)}}">{{$prod->name}}</a></h3>
												<h4 class="product-price">{{$prod->total_price}} L.E
													@if($prod->offer > 0)
													<del class="product-old-price">{{$prod->selling_price}} L.E</del>
												</h4>
												@if($prod->tax > 0)
													<br>
													<p>But there is tax by {{$prod->tax}}%</p>
													@endif
													@endif
											</div>
											<div class="add-to-cart">
												<form action="{{url('category/'.$prod->category->slug.'/'.$prod->slug)}}" method="GET">
												<button class="add-to-cart-btn"><i class="fa fa-eye"></i> quick view</button>
												</form>
											</div>
										</div>
										<!-- /product -->
										@endif
										@endforeach
									</div>
									<div id="slick-nav-{{$item->id}}" class="products-slick-nav"></div>
								</div>
								@endforeach
								<!-- /tab -->


								<!-- tab -->
								<div id="tab0" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1x">
										@foreach($new_products_category as $item)
										@foreach($item->products as $prod)
										@if($prod->status == 1)
										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="{{asset('uploads/ecommerce/product/'.$prod->image)}}" alt="photo">
												<div class="product-label">
													@if($prod->offer > 0)
													<span class="sale">{{$prod->offer}}%</span>
													@endif
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{$prod->category->name}}</p>
												<h3 class="product-name">{{$prod->name}}</h3>
												<h4 class="product-price">{{$prod->total_price}} L.E
													@if($prod->offer > 0)
													<del class="product-old-price">{{$prod->selling_price}}L.E</del>
												</h4>
												@if($prod->tax > 0)
													<br>
													<p>But there is tax by {{$prod->tax}}%</p>
													@endif
													@endif
											</div>
											<div class="add-to-cart">
												<form action="{{url('category/'.$prod->category->slug.'/'.$prod->slug)}}" method="GET">
												<button class="add-to-cart-btn"><i class="fa fa-eye"></i> quick view</button>
												</form>
											</div>
										</div>
										@endif
										<!-- /product -->
										@endforeach
										@endforeach
									</div>
									<div id="slick-nav-1x" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
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
							<h3 class="title">Featured Products</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab0second">All</a></li>
									@foreach($featured_products_category as $item)
									<li class="{{ $item->id == 2 ? 'active' : '' }}"><a data-toggle="tab" href="#tab{{ $item->id }}second" aria-controls="home" role="tab">{{$item->name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								@foreach($featured_products_category as $item)
								<div id="tab{{$item->id}}second" class="tab-pane {{ $item->id == 2 ? 'active' : '' }}">
									<div class="products-slick" data-nav="#slick-nav-{{$item->id}}second">
										@foreach($item->products as $prod)
										<!-- product -->
										@if($prod->trending == 1)
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
												<p class="product-category"><a href="{{url('category/'.$prod->category->slug)}}">{{$prod->category->name}}</a></p>
												<h3 class="product-name"><a href="{{url('category/'.$prod->category->slug.'/'.$prod->slug)}}">{{$prod->name}}</a></h3>
												<h4 class="product-price">{{$prod->total_price}} L.E
													@if($prod->offer > 0)
													<del class="product-old-price">{{$prod->selling_price}}L.E</del>
												</h4>
												@if($prod->tax > 0)
													<br>
													<p>But there is tax by {{$prod->tax}}%</p>
													@endif
													@endif
											</div>
											<div class="add-to-cart">
												<form action="{{url('category/'.$prod->category->slug.'/'.$prod->slug)}}" method="GET">
												<button class="add-to-cart-btn"><i class="fa fa-eye"></i> quick view</button>
												</form>
											</div>
										</div>
										@endif
										@endforeach
										<!-- /product -->
									</div>
									<div id="slick-nav-{{$item->id}}second" class="products-slick-nav"></div>
								</div>
								@endforeach
								<!-- /tab -->

								<div id="tab0second" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-2x">
										@foreach($featured_products_category as $item)
										@foreach($item->products as $prod)
										@if($prod->trending == 1)
										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="{{asset('uploads/ecommerce/product/'.$prod->image)}}" alt="photo">
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
												<p class="product-category"><a href="{{url('category/'.$prod->category->slug)}}">{{$prod->category->name}}</a></p>
												<h3 class="product-name"><a href="{{url('category/'.$prod->category->slug.'/'.$prod->slug)}}">{{$prod->name}}</a></h3>
												<h4 class="product-price">{{$prod->total_price}} L.E
													@if($prod->offer > 0)
													<del class="product-old-price">{{$prod->selling_price}} L.E</del>
												</h4>
												@if($prod->tax > 0)
													<br>
													<p>But there is tax by {{$prod->tax}}%</p>
													@endif
													@endif
											</div>
											<div class="add-to-cart">
												<form action="{{url('category/'.$prod->category->slug.'/'.$prod->slug)}}" method="GET">
												<button class="add-to-cart-btn"><i class="fa fa-eye"></i> quick view</button>
												</form>
											</div>
										</div>
										@endif
										<!-- /product -->
										@endforeach
										@endforeach
									</div>
									<div id="slick-nav-2x" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->

							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection

@push('script')
<script>
	let slideIndex = 0;
	showSlides();
	
	function showSlides() {
	  let i;
	  let slides = document.getElementsByClassName("mySlides");
	  let dots = document.getElementsByClassName("dot");
	  for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";  
	  }
	  slideIndex++;
	  if (slideIndex > slides.length) {slideIndex = 1}    
	  for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace(" active", "");
	  }
	  slides[slideIndex-1].style.display = "block";  
	  dots[slideIndex-1].className += " active";
	  setTimeout(showSlides, 1800); // Change image every 2 seconds
	}
</script>
	
@endpush
