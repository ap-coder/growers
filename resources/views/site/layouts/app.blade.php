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

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Stylesheet -->
    <link class="main-css" rel="stylesheet" type="text/css" href="{{ asset('site/css/style.css') }}?v={{ time() }}">
    <link class="skin" type="text/css" rel="stylesheet" href="{{ asset('site/css/skin/skin-1.css') }}">

    <!-- GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <link class="custom-css" rel="stylesheet" type="text/css" href="{{ asset('site/css/custom.css') }}?v={{ time() }}">
    
    <!-- Scoped Article Editor Content Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/article-content.css') }}?v={{ time() }}">

    @yield('styles')
</head>
<body>
<div class="page-wraper">

    @if(!session('site_loaded'))
    <div id="loading-area" class="loading-page-1">
        <div class="text"><span class="text-primary">Pacific</span> Plant Growers</div>
    </div>
    @php session(['site_loaded' => true]); @endphp
    @endif

    @include('site.layouts.partials.header')

    @if(session()->has('impersonate_original_user_id'))
    <div class="alert alert-warning mb-0 rounded-0 text-center" style="position: sticky; top: 0; z-index: 1030;">
        <div class="container">
            <i class="fas fa-user-secret"></i>
            <strong>Developer Mode:</strong> You are viewing as <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})
            @if(auth()->user()->client)
                - Client: <strong>{{ auth()->user()->client->name }}</strong>
            @endif
            <form action="{{ route('admin.impersonate.stop') }}" method="POST" class="d-inline ms-3">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-times"></i> Stop Impersonating
                </button>
            </form>
        </div>
    </div>
    @endif

    <div class="page-content">
        @yield('banner')

        @yield('content')
    </div>

    @include('site.layouts.partials.footer')

    <button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>

</div>

<!-- JAVASCRIPT FILES -->
<script src="{{ asset('site/js/jquery.min.js') }}"></script><!-- JQUERY MIN JS -->
<script src="{{ asset('site/vendor/wow/wow.min.js') }}"></script><!-- WOW JS -->
<script src="{{ asset('site/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script><!-- BOOTSTRAP MIN JS -->
<script src="{{ asset('site/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script><!-- BOOTSTRAP SELECT MIN JS -->
<script src="{{ asset('site/vendor/bootstrap-touchspin/bootstrap-touchspin.js') }}"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
<script src="{{ asset('site/vendor/counter/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
<script src="{{ asset('site/vendor/swiper/swiper-bundle.min.js') }}"></script><!-- SWIPER JS -->
<script src="{{ asset('site/vendor/imagesloaded/imagesloaded.js') }}"></script><!-- IMAGESLOADED -->
<script src="{{ asset('site/vendor/masonry/masonry-4.2.2.js') }}"></script><!-- MASONRY -->
<script src="{{ asset('site/vendor/masonry/isotope.pkgd.min.js') }}"></script><!-- ISOTOPE -->
<script src="{{ asset('site/vendor/countdown/jquery.countdown.js') }}"></script><!-- COUNTDOWN FUCTIONS -->
<script src="{{ asset('site/vendor/wnumb/wNumb.js') }}"></script><!-- WNUMB -->
<script src="{{ asset('site/vendor/nouislider/nouislider.min.js') }}"></script><!-- NOUSLIDER MIN JS -->
<script src="{{ asset('site/js/dz.carousel.js') }}"></script><!-- DZ CAROUSEL JS -->
<script src="{{ asset('site/js/dz.ajax.js') }}"></script><!-- AJAX -->
<script src="{{ asset('site/vendor/equalheights/jquery.equalheights.min.js') }}"></script><!-- EQUAL HEIGHTS -->
<script src="{{ asset('site/js/custom.js') }}?v={{ time() }}"></script><!-- CUSTOM JS -->

<script>
$(document).on('click', '.favorite-btn', function(e) {
    e.preventDefault();
    var btn = $(this);
    var url = btn.data('url');
    var icon = btn.find('i');

    $.ajax({
        url: url,
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(response) {
            if (response.isFavorited) {
                icon.removeClass('fa-regular').addClass('fa-solid');
            } else {
                icon.removeClass('fa-solid').addClass('fa-regular');
            }
        },
        error: function(xhr) {
            console.error('Error toggling favorite:', xhr);
        }
    });
});
</script>

@yield('scripts')
</body>
</html>
