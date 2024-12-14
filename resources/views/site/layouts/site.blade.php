<!DOCTYPE html>
<html lang="en">
    <head>
        @include('site.layouts.partials.head')
    </head>
    <body id="bg">

        <div class="page-wraper" id="scroll-container">

            <div id="loading-area" class="loading-page-1">
                <div class="text"><span class="text-primary">Plant</span>Zone</div>
            </div>

            <!-- Header Section -->
            @include('site.layouts.partials.header') <!-- Include header partial -->

            <!-- Page Content -->
            <div class="page-content">
                @yield('content') <!-- Placeholder for page-specific content -->
            </div>

            <!-- Footer Section -->
            @include('site.layouts.partials.footer') <!-- Include footer partial -->

        </div>

        


    <!-- JAVASCRIPT FILES ========================================= -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script><!-- JQUERY MIN JS -->
    <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script><!-- WOW JS -->
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script><!-- BOOTSTRAP MIN JS -->
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script><!-- BOOTSTRAP SELECT MIN JS -->
    <script src="{{ asset('assets/vendor/bootstrap-touchspin/bootstrap-touchspin.js') }}"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
    <script src="{{ asset('assets/vendor/counter/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
    <script src="{{ asset('assets/vendor/counter/counterup.min.js') }}"></script><!-- COUNTERUP JS -->
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script><!-- SWIPER JS -->
    <script src="{{ asset('assets/vendor/magnific-popup/magnific-popup.js') }}"></script><!-- MAGNIFIC POPUP JS -->
    <script src="{{ asset('assets/vendor/counter/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
    <script src="{{ asset('assets/vendor/group-slide/group-loop.js') }}"></script><!-- Group JS -->
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.js') }}"></script><!-- IMAGESLOADED -->
    <script src="{{ asset('assets/vendor/masonry/masonry-4.2.2.js') }}"></script><!-- MASONRY -->
    <script src="{{ asset('assets/vendor/masonry/isotope.pkgd.min.js') }}"></script><!-- ISOTOPE -->
    <script src="{{ asset('assets/vendor/countdown/jquery.countdown.js') }}"></script><!-- COUNTDOWN FUNCTIONS -->
    <script src="{{ asset('assets/vendor/wnumb/wNumb.js') }}"></script><!-- WNUMB -->
    <script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script><!-- NOUSLIDER MIN JS -->
    <script src="{{ asset('assets/js/dz.carousel.js') }}"></script><!-- DZ CAROUSEL JS -->
    <script src="{{ asset('assets/vendor/lightgallery/dist/lightgallery.min.js') }}"></script><!-- LIGHTGALLERY -->
    <script src="{{ asset('assets/vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.min.js') }}"></script><!-- LIGHTGALLERY THUMBNAIL -->
    <script src="{{ asset('assets/vendor/lightgallery/dist/plugins/zoom/lg-zoom.min.js') }}"></script><!-- LIGHTGALLERY ZOOM -->
    <script src="{{ asset('assets/js/dz.ajax.js') }}"></script><!-- AJAX -->
    <script src="{{ asset('assets/js/custom.js') }}"></script><!-- CUSTOM JS -->

    <!-- Scripts -->
    @stack('scripts') <!-- For additional scripts on specific pages -->

</body>
</html>
