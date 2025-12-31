<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Pacific Plant Growers')</title>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- FAVICONS ICON -->
    <link rel="icon" type="image/x-icon" href="{{ asset('site/images/favicon.png') }}">
    
    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('site/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('site/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('site/vendor/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('site/vendor/animate/animate.css') }}">
    
    <!-- Custom Stylesheet -->
    <link class="main-css" rel="stylesheet" type="text/css" href="{{ asset('site/css/style.css') }}">
    <link class="skin" type="text/css" rel="stylesheet" href="{{ asset('site/css/skin/skin-1.css') }}">
    
    <!-- GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    
    @yield('styles')
</head>
<body>
<div class="page-wraper">

    <div id="loading-area" class="loading-page-1">
        <div class="text"><span class="text-primary">Pacific</span> Plant Growers</div>
    </div>
    
    @include('site.layouts.partials.header')
    
    <div class="page-content">
        @yield('banner')
        
        @yield('content')
    </div>

    @include('site.layouts.partials.footer')
    
    <button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>

</div>

<!-- JAVASCRIPT FILES -->
<script src="{{ asset('site/js/jquery.min.js') }}"></script>
<script src="{{ asset('site/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('site/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('site/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('site/vendor/bootstrap-touchspin/bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('site/vendor/counter/waypoints-min.js') }}"></script>
<script src="{{ asset('site/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('site/vendor/countdown/jquery.countdown.js') }}"></script>
<script src="{{ asset('site/vendor/wnumb/wNumb.js') }}"></script>
<script src="{{ asset('site/vendor/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('site/js/dz.carousel.js') }}"></script>
<script src="{{ asset('site/js/dz.ajax.js') }}"></script>
<script src="{{ asset('site/js/custom.js') }}"></script>

@yield('scripts')
</body>
</html>
