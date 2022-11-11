	<!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-4 col-xs-8">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <ul class="footer-links">
                                <li><a>{{$datas['name']}}</a></li>
                                <li><a><i class="fa fa-map-marker"></i>{{$datas['location']}}</a></li>
                                <li><a><i class="fa fa-phone"></i>{{$datas['phone']}}</a></li>
                                <li><a><i class="fa fa-envelope-o"></i>{{$datas['email']}}</a></li>
                                <li><a>Opening Hours : {{$datas['open_hours']}}</a></li>

                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-8">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                @foreach($cat as $categories)
                                <li><a href="{{url('category/'.$categories->slug)}}">{{$categories->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-4 col-xs-8">
                        <div class="footer">
                            <h3 class="footer-title">Pages</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->
    </footer>
    <!-- /FOOTER -->