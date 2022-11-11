@extends('layouts.frontend.front')

@section('title','Checkout')

@section('content')

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
				<form action="{{url('place-order')}}" method="POST">
					@csrf
					
					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="name" value="{{Auth::user()->name}}" placeholder="Name">
							</div>
							@error('name')
							<span style="color:red"><strong>{{$message}}</strong></span>
							@enderror

							<div class="form-group">
								<input class="input" type="email" value="Email : {{Auth::user()->email}}" disabled>
							</div>
							@error('email')
							<span style="color:red"><strong>{{$message}}</strong></span>
							@enderror

							<div class="form-group">
								<input class="input" type="tel" name="mobile" placeholder="Mbile Phone" value="{{Auth::user()->mobile}}">
							</div>
							@error('mobile')
							<span style="color:red"><strong>{{$message}}</strong></span>
							@enderror

							<div class="form-group">
								<input class="input" type="tel" name="phone" placeholder="Home Phone *Not Required*" value="{{Auth::user()->phone}}">
							</div>
							@error('phone')
							<span style="color:red"><strong>{{$message}}</strong></span>
							@enderror

                            <div class="form-group">
								<input class="input" type="text" value="Country : Egypt" disabled>
							</div>
						
                            <div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							@error('city')
							<span style="color:red"><strong>{{$message}}</strong></span>
							@enderror
							
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>
							@error('address')
							<span style="color:red"><strong>{{$message}}</strong></span>
							@enderror

							<div class="form-group">
								<input class="input" type="text" name="pin_code" placeholder="Pin Code">
							</div>
							@error('pin_code')
							<span style="color:red"><strong>{{$message}}</strong></span>
							@enderror

						</div>
						<!-- /Billing Details -->

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" name="note" placeholder="Order Notes"></textarea>
						</div>
						@error('note')
							<span style="color:red"><strong>{{$message}}</strong></span>
						@enderror
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>Color</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
                                @php $total = 0; @endphp
                                @foreach($cartItems as $item)
								<div class="order-col">
									<div>{{$item->product_qty}}x {{$item->products->name}}</div>
									<div>{{$item->color}}</div>
									<div>{{$item->product_qty * $item->products->total_price}} L.E</div>
								</div>
                                @php $total += $item->products->total_price * $item->product_qty; @endphp
                                @endforeach
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">{{$total}} L.E</strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<button style="postion: block; margin-top: 30px;" class="primary-btn">Place order</button>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</form>
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
@endsection
