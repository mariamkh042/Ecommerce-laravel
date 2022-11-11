@php 
if(Auth::check()){
	$cart = \App\Models\Cart::where('user_id',Auth::user()->id)->get();
	$wish = \App\Models\WishList::where('user_id',Auth::user()->id)->count();
	$total = 0 ;
	foreach ($cart as $item) {
		$total += $item->products->total_price * $item->product_qty;
	}
}
@endphp
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <title> @yield('title') </title>

 		@include('layouts.frontend.head.links')

    </head>
	<body>
        <!-- HEADER -->
		<header>
            <!-- TOP HEADER -->
            <div id="top-header">
            <div class="container">
              <ul class="header-links pull-left">
                <li style="color:white"><i class="fa fa-phone"></i> {{$datas['phone']}}</li>
                <li style="color:white"><i class="fa fa-envelope-o"></i> {{$datas['email']}}</li>
                <li style="color:white"><i class="fa fa-map-marker"></i> {{$datas['location']}}</li>
              </ul>
            </div>
            </div>
            <!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="{{url('/')}}" class="logo">
									<img src="{{asset('uploads/ecommerce/logo/'.$logo->logo)}}" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{url("searchproduct")}}" method="POST">
									@method('POST')
									@csrf
									{{-- <select class="input-select">
										<option value="">All Categories</option>
									</select> --}}
									<input type="search" id="search_product" name="product_name" class="input" placeholder="Search here">
									<button type="submit" class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								@if(Auth::check())
								<!-- Wishlist -->
								<div>
									<a href="{{url('wishlist')}}">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">{{$wish}}</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">{{$cart->count()}}</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-summary">
											<small>{{$cart->count()}} Item(s) selected</small>
											<h5>SUBTOTAL: {{$total}}L.E</h5>
										</div>
										<div class="cart-btns">
											<a  href="{{url('cart')}}">View Cart</a>
											<a href="{{url('checkout')}}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->
								@endif

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		@include('layouts.frontend.header.nav')
		
		
        @yield('content')
				
		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							@if(!Auth::check())
							<p>Sign Up for free</p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email" disabled>
								<button class="newsletter-btn"><a href="{{route('register')}}" class="newsletter-btn"><i class="fa fa-envelope"></i> Register</a></button>
							</form>
							@endif
							<ul class="newsletter-follow">
								<li>
									<a href="{{$datas['facebook']}}"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="{{$datas['twitter']}}"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="{{$datas['instagram']}}"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="{{$datas['youtube']}}"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

	
		@include('layouts.frontend.footer.footer')


		@include('layouts.frontend.footer.links')

		<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
		<script>
			$( function() {
			  var availableTags = [];
			  $.ajax({
				method:"GET",
				url:"product-list",
				success:function(response){
					startAutoComplete(response);
				}
			  });
			});
			function startAutoComplete(availableTags){
			  $("#search_product").autocomplete({
			  source: availableTags
    		  });
			}
			</script>
	</body>
</html>
