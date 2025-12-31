<!-- Footer -->
<footer class="site-footer style-2">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="widget widget_about me-2">
                        <div class="footer-logo logo-white">
                            <a href="{{ route('frontend.home') }}"><img src="{{ asset('site/images/logo.svg') }}" alt=""></a> 
                        </div>
                        <ul class="widget-address">
                            <li>
                                <p><span>Address</span> : Layton, Utah</p>
                            </li>
                            <li>
                                <p><span>E-mail</span> : <a href="mailto:info@pacificplantgrowers.com">info@pacificplantgrowers.com</a></p>
                            </li>
                            <li>
                                <p><span>Phone</span> : <a href="tel:8017908100">801.790.8100</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="widget widget_services">
                        <h2 class="footer-title">Quick Links</h2>
                        <ul>
                            <li><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li><a href="{{ route('frontend.products.index') }}">Products</a></li>
                            <li><a href="{{ route('site.how-to-order') }}">How to Order</a></li>
                            <li><a href="{{ route('site.account.orders') }}">My Orders</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="widget widget_services">
                        <h2 class="footer-title">Categories</h2>
                        <ul>
                            <li><a href="#">Baskets</a></li>
                            <li><a href="#">Ceramics</a></li>
                            <li><a href="#">Tins</a></li>
                            <li><a href="#">Wood</a></li>
                            <li><a href="#">Novelty</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="widget widget_services">
                        <h2 class="footer-title">Seasonal</h2>
                        <ul>
                            <li><a href="#">Valentines</a></li>
                            <li><a href="#">Spring</a></li>
                            <li><a href="#">Mother's Day</a></li>
                            <li><a href="#">Summer</a></li>
                            <li><a href="#">Fall</a></li>
                            <li><a href="#">Christmas</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Top End -->
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row fb-inner wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-12 text-center"> 
                    <p class="copyright-text">© {{ date('Y') }} Pacific Plant Growers. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->
</footer>
<!-- Footer End -->
