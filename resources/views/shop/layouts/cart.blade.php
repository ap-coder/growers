<!DOCTYPE html>
<html lang="en">
	@include('shop.layouts.partials.head')

	<body>
	<div class="page-wraper">
		<div id="loading-area" class="loading-page-1">
			<div class="text"><span class="text-primary">Pacific Plant </span>Growers</div>
		</div>
			
		<!-- Header Star -->
		@include('account.layouts.partials.header')
		<!-- Header End -->
				
		<div class="page-content">
			@yield('content')
		</div>
	
		<!-- Footer -->
		@include('account.layouts.partials.footer')
		<!-- Footer End -->
		
		<button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>
	</div>
	<!-- JAVASCRIPT FILES ========================================= -->
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script><!-- JQUERY MIN JS -->
	<script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script><!-- WOW JS -->
	<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script><!-- BOOTSTRAP MIN JS -->
	<script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script><!-- BOOTSTRAP SELECT MIN JS -->
	<script src="{{ asset('assets/vendor/bootstrap-touchspin/bootstrap-touchspin.js') }}"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
	<script src="{{ asset('assets/vendor/counter/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
	<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script><!-- SWIPER JS -->
	<script src="{{ asset('assets/vendor/countdown/jquery.countdown.js') }}"></script><!-- COUNTDOWN FUCTIONS  -->
	<script src="{{ asset('assets/vendor/wnumb/wNumb.js') }}"></script><!-- WNUMB -->
	<script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script><!-- NOUSLIDER MIN JS-->
	<script src="{{ asset('assets/js/dz.carousel.js') }}"></script><!-- DZ CAROUSEL JS -->
	<script src="{{ asset('assets/js/dz.ajax.js') }}"></script><!-- AJAX -->
	<script src="{{ asset('assets/js/custom.js') }}"></script><!-- CUSTOM JS -->
	</body>
</html>