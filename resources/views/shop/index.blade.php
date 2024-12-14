@extends('shop.layouts.shop')

@section('title', 'Shop')

@section('styles')
    @parent

@endsection

@section('content')
		<!--Banner Start-->
		<div class="dz-bnr-inr" style="background-image:url(images/background/bg1.jpg);">
			<div class="container">
				<div class="dz-bnr-inr-entry">
					<nav aria-label="breadcrumb" class="breadcrumb-row">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html"> Home</a></li>
							<li class="breadcrumb-item">Shop With Category</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<!--Banner End-->
		<section class="content-inner-3 pt-3 z-index-unset">
			<div class="container-fluid">
				<div class="row mt-xl-2 mt-0">
					<div class="col-20 col-xl-3">
						<div class="sticky-xl-top">
							<a href="javascript:void(0);" class="panel-close-btn">
								<svg width="35" height="35" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M37.748 12.5L12.748 37.5" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M12.748 12.5L37.748 37.5" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
							<div class="shop-filter mt-xl-2 mt-0">

							@include('shop.layouts.partials.shop-aside')


							</div>
						</div>
					</div>
					<div class="col-80 col-xl-9">
						<h2 class="mb-3">Category</h2>
						{{-- @include('shop.layouts.partials.shop-carousel') --}}
						@include('shop.layouts.partials.main-filter')
						@include('shop.layouts.partials.main-products')
						@include('shop.layouts.partials.main-paginate')
					</div>
				</div>
			</div>
		</section>

{{-- @include('shop.layouts.partials.newsletter')--}}

@endsection

@section('scripts')
	@parent

@endsection
