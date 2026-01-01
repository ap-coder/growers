<!-- Footer -->
@php
    $footerAddress = \App\Models\Setting::get('footer_address') ?: \App\Models\Setting::get('company_address') ?: "Pacific Plant Growers\n1697 W 2100 N.\nLehi, UT 84043";
    $footerEmail = \App\Models\Setting::get('footer_email') ?: \App\Models\Setting::get('company_email') ?: 'orders@pacificplantgrowers.com';
    $footerPhone = \App\Models\Setting::get('footer_phone') ?: \App\Models\Setting::get('company_phone') ?: '801-768-2809';
    $footerDisclaimer = \App\Models\Setting::get('footer_disclaimer');
    $companyName = \App\Models\Setting::get('company_name', 'Pacific Plant Growers');
    $companyLogo = \App\Models\Setting::get('company_logo');
@endphp
<footer class="site-footer style-2">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="widget widget_about me-2">
                        <div class="footer-logo logo-white">
                            @if($companyLogo)
                                <a href="{{ route('frontend.home') }}"><img src="{{ asset('storage/' . $companyLogo) }}" alt="{{ $companyName }}"></a>
                            @else
                                <a href="{{ route('frontend.home') }}"><img src="{{ asset('site/images/logo.svg') }}" alt="{{ $companyName }}"></a>
                            @endif
                        </div>
                        <ul class="widget-address">
                            <li>
                                <p><span>Address</span> : {!! nl2br(e($footerAddress)) !!}</p>
                            </li>
                            <li>
                                <p><span>E-mail</span> : <a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a></p>
                            </li>
                            <li>
                                <p><span>Phone</span> : <a href="tel:{{ preg_replace('/[^0-9]/', '', $footerPhone) }}">{{ $footerPhone }}</a></p>
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
                    <p class="copyright-text">
                        @if($footerDisclaimer)
                            {!! e($footerDisclaimer) !!}
                        @else
                            © {{ date('Y') }} {{ $companyName }}. All Rights Reserved.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->
</footer>
<!-- Footer End -->
