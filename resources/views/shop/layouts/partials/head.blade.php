	<head>

		<!-- Title -->
		<title>@yield('title', 'Pacific Plant Growers')</title>
	
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="author" content="DexignZone">
		<meta name="robots" content="index, follow">
		<meta name="format-detection" content="telephone=no">
		
		<meta name="keywords" content="garden shop, flowers, landscape gardener, delivery, ecommerce, greenery, order, shopping, store, portfolio, plant template, plant store, plant showcase, nursery technology, ecommerce web, eCommerce website, minimal shop, online shop, online shopping, plantzone, user interface, user experience, trendy, stylish, development, farmer">
		
		<meta name="description" content="">
		
		<meta property="og:title" content="">
		<meta property="og:description" content="">
		<meta property="og:image" content="">
		
		<!-- TWITTER META -->
		<meta name="twitter:title" content="">
		<meta name="twitter:description" content="">
		<meta name="twitter:image" content="">
		<meta name="twitter:card" content="summary_large_image">
		
		<!-- CANONICAL URL -->
		<link rel="canonical" href=" {{ url()->current() }}">
		
		<!-- FAVICONS ICON -->
		<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
		
		<!-- MOBILE SPECIFIC -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- STYLESHEETS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.css') }}">

		<!-- Custom Stylesheet -->
		<link class="main-css" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
		<link class="skin" type="text/css" rel="stylesheet" href="{{ asset('assets/css/skin/skin-1.css') }}">
		
		<!-- GOOGLE FONTS-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">

		@stack('styles')
</head>