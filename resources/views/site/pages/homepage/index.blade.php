@extends('site.layouts.app')

@section('site-styles') @endsection
@section('page-styles') @endsection

@section('page-content')

    <div class="page-content">

	<!-- Banner Start -->
	<div class="main-banner style-1">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-3 col-lg-7 col-md-7 align-self-start order-md-0 order-1">
					<div class="single-product-info-left">
						<div class="content-info">
							<h1 class="title wow fadeInUp" data-wow-delay="0.2s">Plant make better  life</h1>

							<div class="meta-content wow fadeInUp m-b20" data-wow-delay="0.4s">
								<span class="price-name">Price</span>
								<span class="price-num">$125.75</span>
							</div>
							<div class="meta-content wow fadeInUp m-b30 m-lg-b40" data-wow-delay="0.6s">
								<span class="select-size">Select Size</span>
								<div class="btn-group product-size">
									<input type="radio" class="btn-check" name="btnradio1" id="btnradio101" checked="">
									<label class="btn" for="btnradio101">S</label>

									<input type="radio" class="btn-check" name="btnradio1" id="btnradiol02">
									<label class="btn" for="btnradiol02">M</label>

									<input type="radio" class="btn-check" name="btnradio1" id="btnradiol03">
									<label class="btn" for="btnradiol03">L</label>

									<input type="radio" class="btn-check" name="btnradio1" id="btnradiol04">
									<label class="btn" for="btnradiol04">X</label>
								</div>
							</div>
							<div class="content-btn wow fadeInUp" data-wow-delay="0.6s" data-swiper-parallax="-60" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
								<a class="btn btn-outline-secondary me-lg-2 btn-lg" href="product-default.html">View Details</a>
								<a class="btn btn-secondary  btn-lg" href="shop-cart.html">Add To Cart</a>
							</div>
						</div>
					</div>
					<div class="bottom-contant">
						<div class="Plant-2">
							<div class="dz-media">
								<img src="images/shop/product/4.png" alt="image">
							</div>
						</div>
						<div class="Plant-2">
							<div class="dz-media">
								<img src="images/shop/product/3.png" alt="image">
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-md-8 col-sm-12  order-3 order-xl-2 ">
					<div class="tab-content single-product-media">
						<div class="tab-pane fade show active" id="banner-Plant_1-pane" role="tabpanel" aria-labelledby="banner-Plant_1" tabindex="0">
							<div class="dz-media">
								<img src="images/shop/product1.png" alt="/">
							</div>
							<ul class="list-check style-1">
								<li class="list-1">Connection to Nature</li>
								<li class="list-2 right">Temperature Regulation</li>
								<li class="list-3">Improved Air Quality</li>
								<li class="list-4 right">Humidity Regulation</li>
							</ul>
						</div>
						<div class="tab-pane fade show" id="banner-Plant_2-pane" role="tabpanel" aria-labelledby="banner-Plant_2" tabindex="0">
							<div class="dz-media">
								<img src="images/shop/product2.png" alt="/">
							</div>
							<ul class="list-check style-1">
								<li class="list-1">Connection to Nature</li>
								<li class="list-2 right">Temperature Regulation</li>
								<li class="list-3">Improved Air Quality</li>
								<li class="list-4 right">Humidity Regulation</li>
							</ul>
						</div>
						<div class="tab-pane fade show" id="banner-Plant_3-pane" role="tabpanel" aria-labelledby="banner-Plant_3" tabindex="0">
							<div class="dz-media">
								<img src="images/shop/product3.png" alt="/">
							</div>
							<ul class="list-check style-1">
								<li class="list-1">Connection to Nature</li>
								<li class="list-2 right">Temperature Regulation</li>
								<li class="list-3">Improved Air Quality</li>
								<li class="list-4 right">Humidity Regulation</li>
							</ul>
						</div>
						<div class="tab-pane fade show" id="banner-Plant_4-pane" role="tabpanel" aria-labelledby="banner-Plant_4" tabindex="0">
							<div class="dz-media">
								<img src="images/shop/product4.png" alt="/">
							</div>
							<ul class="list-check style-1">
								<li class="list-1">Connection to Nature</li>
								<li class="list-2 right">Temperature Regulation</li>
								<li class="list-3">Improved Air Quality</li>
								<li class="list-4 right">Humidity Regulation</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-5 col-md-5 col-sm-12  order-2 order-xl-3 ">
					<div class="single-product-info-right ">
						<ul class="nav nav-tabs center banner-Plant row justify-content-end border-0" id="myTab-3" role="tablist">
							<li class="col-xl-5 col-lg-6 col-md-6 col-sm-3  col-6  nav-item" role="presentation">
								<button class="nav-link active" id="banner-Plant_1" data-bs-toggle="tab" data-bs-target="#banner-Plant_1-pane" type="button" role="tab" aria-controls="banner-Plant_1" aria-selected="true">
									<span class="Plant-1">
										<span class="dz-media">
											<img src="images/shop/medium/1.png" alt="image">
										</span>
									</span>
								</button>
							</li>
							<li class="col-xl-5 col-lg-6 col-md-6 col-sm-3  col-6  nav-item p-t50" role="presentation">
								<button class="nav-link" id="banner-Plant_2" data-bs-toggle="tab" data-bs-target="#banner-Plant_2-pane" type="button" role="tab" aria-controls="banner-Plant_2" aria-selected="true">
									<span class="Plant-1">
										<span class="dz-media">
											<img src="images/shop/medium/2.png" alt="image">
										</span>
									</span>
								</button>
							</li>
							<li class="col-xl-5 col-lg-6 col-md-6 col-sm-3  col-6  nav-item" role="presentation">
								<button class="nav-link" id="banner-Plant_3" data-bs-toggle="tab" data-bs-target="#banner-Plant_3-pane" type="button" role="tab" aria-controls="banner-Plant_3" aria-selected="true">
									<span class="Plant-1">
										<span class="dz-media">
											<img src="images/shop/medium/3.png" alt="image">
										</span>
									</span>
								</button>
							</li>
							<li class="col-xl-5 col-lg-6 col-md-6 col-sm-3  col-6  nav-item p-t50" role="presentation">
								<button class="nav-link" id="banner-Plant_4" data-bs-toggle="tab" data-bs-target="#banner-Plant_4-pane" type="button" role="tab" aria-controls="banner-Plant_4" aria-selected="true">
									<span class="Plant-1">
										<span class="dz-media">
											<img src="images/shop/medium/4.png" alt="image">
										</span>
									</span>
								</button>
							</li>
						</ul>
						<div class="bottom-contant">
							<div class="Plant-2">
								<div class="dz-media">
									<img src="images/shop/product/6.png" alt="image">
								</div>
							</div>
							<div class="Plant-2">
								<div class="dz-media">
									<img src="images/shop/product/1.png" alt="image">
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="right-text-bar">
			<ul>
				<li>
					<a  href="shop-with-category.html">Recent Items</a>
				</li>
				<li><img src="images/shop/small/pic1.png" alt=""></li>
				<li><img src="images/shop/small/pic2.png" alt=""></li>
			</ul>
		</div>
		<span class="data-text ">Plant</span>
	</div>
        <!-- Banner End-->

        <!--category section-->
	<section class="content-inner p-b0">
		<div class="container">
			<div class="section-head style-3 d-flex align-items-center justify-content-between left wow fadeInUp m-b30">
				<div class="left-content">
					<h2 class="title">Find Plant Category</h2>
				</div>
				<div class="right-content">
					<a  class="tranding-button-prev me-3">
						<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M46.0938 24.2149H5.83226L15.3599 14.9528C16.0879 14.2456 15.0081 13.1198 14.2704 13.8329C14.2704 13.8328 3.36152 24.4377 3.36152 24.4377C3.04321 24.7276 3.06856 25.2508 3.36156 25.5577C3.36152 25.5577 14.2704 36.1671 14.2704 36.1671C15.0046 36.8717 16.0905 35.7669 15.3599 35.0471C15.3599 35.0471 5.82873 25.7774 5.82873 25.7774H46.0938C47.0921 25.768 47.1436 24.234 46.0938 24.2149Z" fill="black"/>
						</svg>
					</a>
					<a  class="tranding-button-next">
						<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3.90623 24.2149H44.1677L34.6401 14.9528C33.9121 14.2456 34.9919 13.1198 35.7296 13.8329C35.7296 13.8328 46.6385 24.4377 46.6385 24.4377C46.9568 24.7276 46.9314 25.2508 46.6384 25.5577C46.6385 25.5577 35.7296 36.1671 35.7296 36.1671C34.9954 36.8717 33.9095 35.7669 34.6401 35.0471C34.6401 35.0471 44.1713 25.7774 44.1713 25.7774H3.90623C2.90785 25.768 2.85645 24.234 3.90623 24.2149Z" fill="black"/>
						</svg>
					</a>
				</div>
			</div>
			<div class="swiper swiper-slider category-swiper2">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="category-product box-hover ">
							<h3 class="title"><a href="shop-with-category.html">Indoor Plants</a></h3>
							<img src="images/shop/plant/1.png" alt="">
						</div>
					</div>
					<div class="swiper-slide">
						<div class="category-product box-hover ">
							<h3 class="title"><a href="shop-with-category.html">House Plant</a></h3>
							<img src="images/shop/plant/2.png" alt="">
						</div>
					</div>
					<div class="swiper-slide">
						<div class="category-product box-hover ">
							<h3 class="title"><a href="shop-with-category.html">Tropical</a></h3>
							<img src="images/shop/plant/3.png" alt="">
						</div>
					</div>
					<div class="swiper-slide">
						<div class="category-product box-hover ">
							<h3 class="title"><a href="shop-with-category.html">Succulents</a></h3>
							<img src="images/shop/plant/4.png" alt="">
						</div>
					</div>
					<div class="swiper-slide">
						<div class="category-product box-hover ">
							<h3 class="title"><a href="shop-with-category.html">Lavender</a></h3>
							<img src="images/shop/plant/5.png" alt="">
						</div>
					</div>
					<div class="swiper-slide">
						<div class="category-product box-hover ">
							<h3 class="title"><a href="shop-with-category.html">Indoor Plants</a></h3>
							<img src="images/shop/plant/1.png" alt="">
						</div>
					</div>
					<div class="swiper-slide">
						<div class="category-product box-hover ">
							<h3 class="title"><a href="shop-with-category.html">House Plant</a></h3>
							<img src="images/shop/plant/2.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
        <!--category section-->


        <!--About Section Start -->
	<section class="content-inner overflow-hidden">
		<div class="container">
			<div class="row about-style1 align-items-end m-b0 m-lg-b50">
				<div class="col-lg-6 col-md-12 align-self-center m-b30">
					<div class="row align-items-end">
						<div class="col-lg-6 col-md-6 col-sm-6 m-lg-b80">
							<div class="shop-card ">
								<div class="dz-media">
									<img src="images/shop/product/1.png" alt="image">
									<div class="shop-meta">

										<div class="btn btn-primary meta-icon dz-wishicon">
											<i class="icon feather icon-heart dz-heart"></i>
											<i class="icon feather icon-heart-on dz-heart-fill"></i>
										</div>
										<a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
											<i class="flaticon flaticon-eye d-md-none d-block"></i>
											<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
										</a>
										<div class="btn btn-primary meta-icon dz-carticon">
											<i class="flaticon flaticon-basket"></i>
											<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
										</div>
									</div>
								</div>
								<div class="dz-content">
									<h2 class="title"><a href="shop-list.html">Large Majesty Palm (m)</a></h2>
									<h6 class="price">
										$1099
										<del>$659</del>
									</h6>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="shop-card ">
								<div class="dz-media">
									<img src="images/shop/product/2.png" alt="image">
									<div class="shop-meta">

										<div class="btn btn-primary meta-icon dz-wishicon">
											<i class="icon feather icon-heart dz-heart"></i>
											<i class="icon feather icon-heart-on dz-heart-fill"></i>
										</div>
										<a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
											<i class="flaticon flaticon-eye d-md-none d-block"></i>
											<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
										</a>
										<div class="btn btn-primary meta-icon dz-carticon">
											<i class="flaticon flaticon-basket"></i>
											<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
										</div>
									</div>
								</div>
								<div class="dz-content">
									<h2 class="title"><a href="shop-list.html">Large Majesty Palm (m)</a></h2>
									<h6 class="price">
										$1099
										<del>$659</del>
									</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12 m-b30">
					<div class="about-content">
						<div class="section-head style-1 wow fadeInUp" data-wow-delay="0.4s">
							<h2 class="title ">Make Your Home Good Nutrition</h2>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
						</div>
						<div class="d-flex justify-content-between align-items-center">
							<a class="btn btn-outline-secondary m-b30 btn-lg" href="about-us.html">View Details</a>
							<a class="icon-button d-md-inline-block d-none" href="shop-standard.html">
								<div class="text-row word-rotate-box c-black">
									<span class="word-rotate">All Product - All Product  -</span>
									<svg class="badge__emoji" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
										<g clip-path="url(#clip0_85_881)">
											<path d="M31.3072 10.7239L39.5891 19.0059C39.8523 19.2696 40.0001 19.627 40.0001 19.9995C40.0001 20.3721 39.8523 20.7295 39.5891 20.9932L31.3072 29.2752C31.1236 29.4582 30.8748 29.5608 30.6156 29.5606C30.3564 29.5604 30.1078 29.4573 29.9245 29.274C29.7412 29.0907 29.6381 28.8422 29.6379 28.5829C29.6377 28.3237 29.7404 28.075 29.9234 27.8913L36.8368 20.9781L0.978516 20.9781C0.718997 20.9781 0.470108 20.875 0.2866 20.6915C0.103093 20.508 -1.17109e-07 20.2591 -1.14015e-07 19.9995C-1.1092e-07 19.74 0.103093 19.4911 0.2866 19.3076C0.470108 19.1241 0.718997 19.021 0.978516 19.021L36.8368 19.021L29.9234 12.1077C29.7404 11.9241 29.6377 11.6754 29.6379 11.4162C29.6381 11.1569 29.7412 10.9084 29.9245 10.7251C30.1078 10.5418 30.3564 10.4387 30.6156 10.4385C30.8748 10.4383 31.1236 10.5409 31.3072 10.7239Z" fill="black"/>
										</g>
										<defs>
											<clipPath id="clip0_85_881">
											<rect width="40" height="40" fill="white" transform="matrix(-1.19249e-08 1 1 1.19249e-08 0 0)"/>
											</clipPath>
										</defs>
									</svg>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>

			<ul class="list-check style-1">
				<li>Improved Air Quality</li>
				<li>Humidity Regulation</li>
				<li>Stress Reduction</li>
				<li>Temperature Regulation</li>
				<li>Connection to Nature</li>
			</ul>
		</div>
	</section>
        <!--About Section End -->


	<section class="content-inner position-relative z-1 overflow-hidden" id="Plant_section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-7 col-lg-9 col-sm-12 m-b30">
					<div class="service-box wow zoomIn" data-wow-delay="1s">
						<ul class="nav nav-tabs Plant_row"  id="Plant_row" style="--sr-total: 6" role="tablist">
							<li class="nav-item " style="--sr-item:1" role="presentation">
								<button class="nav-link active" id="plant_1" data-bs-toggle="tab" data-bs-target="#plant_1-pane" type="button" role="tab" aria-controls="plant_1-pane" aria-selected="true">
									<span class="plant-bx ">
										<span class="dz-media">
											<img src="images/shop/small/pic1.png" alt="">
										</span>
									</span>
								</button>
							</li>
							<li class="nav-item " style="--sr-item:2" role="presentation">
								<button class="nav-link" id="plant_2" data-bs-toggle="tab" data-bs-target="#plant_2-pane" type="button" role="tab" aria-controls="plant_2-pane" aria-selected="true">
									<span class="plant-bx ">
										<span class="dz-media">
											<img src="images/shop/small/pic2.png" alt="">
										</span>
									</span>
								</button>
							</li>
							<li class="nav-item " style="--sr-item:3" role="presentation">
								<button class="nav-link" id="plant_3" data-bs-toggle="tab" data-bs-target="#plant_3-pane" type="button" role="tab" aria-controls="plant_3-pane" aria-selected="true">
									<span class="plant-bx ">
										<span class="dz-media">
											<img src="images/shop/small/pic3.png" alt="">
										</span>
									</span>
								</button>
							</li>
							<li class="nav-item " style="--sr-item:4" role="presentation">
								<button class="nav-link" id="plant_4" data-bs-toggle="tab" data-bs-target="#plant_4-pane" type="button" role="tab" aria-controls="plant_4-pane" aria-selected="true">
									<span class="plant-bx ">
										<span class="dz-media">
											<img src="images/shop/small/pic4.png" alt="">
										</span>
									</span>
								</button>
							</li>
							<li class="nav-item " style="--sr-item:5" role="presentation">
								<button class="nav-link" id="plant_5" data-bs-toggle="tab" data-bs-target="#plant_5-pane" type="button" role="tab" aria-controls="plant_5-pane" aria-selected="true">
									<span class="plant-bx ">
										<span class="dz-media">
											<img src="images/shop/small/pic5.png" alt="">
										</span>
									</span>
								</button>
							</li>
							<li class="nav-item " style="--sr-item:6" role="presentation">
								<button class="nav-link" id="plant_6" data-bs-toggle="tab" data-bs-target="#plant_6-pane" type="button" role="tab" aria-controls="plant_6-pane" aria-selected="true">
									<span class="plant-bx ">
										<span class="dz-media">
											<img src="images/shop/small/pic6.png" alt="">
										</span>
									</span>
								</button>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="plant_1-pane" role="tabpanel" aria-labelledby="plant_1" tabindex="0">
								<div class="content">
									<div class="shop-card ">
										<div class="dz-media">
											<img src="images/shop/product/1.png" alt="image">
											<div class="shop-meta">
												<div class="btn btn-primary meta-icon dz-wishicon">
													<i class="icon feather icon-heart dz-heart"></i>
													<i class="icon feather icon-heart-on dz-heart-fill"></i>
												</div>
												<div class="btn btn-primary meta-icon dz-carticon">
													<i class="flaticon flaticon-basket"></i>
													<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
												</div>
											</div>
										</div>
										<div class="dz-content">
											<h2 class="title"><a href="shop-list.html">Vineyard Reach (m)</a></h2>
											<span class="price">
												$659
												<del>$1099</del>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade show " id="plant_2-pane" role="tabpanel" aria-labelledby="plant_2" tabindex="0">
								<div class="content">
									<div class="shop-card ">
										<div class="dz-media">
											<img src="images/shop/product/2.png" alt="image">
											<div class="shop-meta">
												<div class="btn btn-primary meta-icon dz-wishicon">
													<i class="icon feather icon-heart dz-heart"></i>
													<i class="icon feather icon-heart-on dz-heart-fill"></i>
												</div>
												<div class="btn btn-primary meta-icon dz-carticon">
													<i class="flaticon flaticon-basket"></i>
													<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
												</div>
											</div>
										</div>
										<div class="dz-content">
											<h2 class="title"><a href="shop-list.html">TallS talk Gardens (m)</a></h2>
											<span class="price">
												$759
												<del>$1199</del>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade show " id="plant_3-pane" role="tabpanel" aria-labelledby="plant_3" tabindex="0">
								<div class="content">
									<div class="shop-card ">
										<div class="dz-media">
											<img src="images/shop/product/3.png" alt="image">
											<div class="shop-meta">
												<div class="btn btn-primary meta-icon dz-wishicon">
													<i class="icon feather icon-heart dz-heart"></i>
													<i class="icon feather icon-heart-on dz-heart-fill"></i>
												</div>
												<div class="btn btn-primary meta-icon dz-carticon">
													<i class="flaticon flaticon-basket"></i>
													<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
												</div>
											</div>
										</div>
										<div class="dz-content">
											<h2 class="title"><a href="shop-list.html">Endless Stems Gardens (m)</a></h2>
											<span class="price">
												$459
												<del>$999</del>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade show " id="plant_4-pane" role="tabpanel" aria-labelledby="plant_4" tabindex="0">
								<div class="content">
									<div class="shop-card ">
										<div class="dz-media">
											<img src="images/shop/product/4.png" alt="image">

											<div class="shop-meta">

												<div class="btn btn-primary meta-icon dz-wishicon">
													<i class="icon feather icon-heart dz-heart"></i>
													<i class="icon feather icon-heart-on dz-heart-fill"></i>
												</div>
												<div class="btn btn-primary meta-icon dz-carticon">
													<i class="flaticon flaticon-basket"></i>
													<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
												</div>
											</div>
										</div>
										<div class="dz-content">
											<h2 class="title"><a href="shop-list.html">Long Vine Flora (m)</a></h2>
											<span class="price">
												$989
												<del>$2199</del>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade show " id="plant_5-pane" role="tabpanel" aria-labelledby="plant_5" tabindex="0">
								<div class="content">
									<div class="shop-card ">
										<div class="dz-media">
											<img src="images/shop/product/5.png" alt="image">
											<div class="shop-meta">
												<div class="btn btn-primary meta-icon dz-wishicon">
													<i class="icon feather icon-heart dz-heart"></i>
													<i class="icon feather icon-heart-on dz-heart-fill"></i>
												</div>
												<div class="btn btn-primary meta-icon dz-carticon">
													<i class="flaticon flaticon-basket"></i>
													<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
												</div>
											</div>
										</div>
										<div class="dz-content">
											<h2 class="title"><a href="shop-list.html">Long Vine Flora (m)</a></h2>
											<span class="price">
												$565
												<del>$1099</del>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade show " id="plant_6-pane" role="tabpanel" aria-labelledby="plant_6" tabindex="0">
								<div class="content">
									<div class="shop-card ">
										<div class="dz-media">
											<img src="images/shop/product/6.png" alt="image">
											<div class="shop-meta">
												<div class="btn btn-primary meta-icon dz-wishicon">
													<i class="icon feather icon-heart dz-heart"></i>
													<i class="icon feather icon-heart-on dz-heart-fill"></i>
												</div>
												<div class="btn btn-primary meta-icon dz-carticon">
													<i class="flaticon flaticon-basket"></i>
													<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
												</div>
											</div>
										</div>
										<div class="dz-content">
											<h2 class="title"><a href="shop-list.html">Bacopa sutera cordata (m)</a></h2>
											<span class="price">
												$659
												<del>$1099</del>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class=" plant-row">
			<div class="tag-slider style-1 wow fadeInUp" data-wow-delay="0.2s" id="tagSlider">
				<div class="item-wrap">
					<div class="item">
						<span class="plant-text">Set</span>
					</div>
					<div class="item">
						<span class="plant-text">your</span>
					</div>
					<div class="item">
						<span class="plant-text">environment </span>
					</div>
					<div class="item">
						<span class="plant-text">Set</span>
					</div>
					<div class="item">
						<span class="plant-text">your</span>
					</div>
					<div class="item">
						<span class="plant-text">environment </span>
					</div>
					<div class="item">
						<span class="plant-text">Set</span>
					</div>
					<div class="item">
						<span class="plant-text">your</span>
					</div>
					<div class="item">
						<span class="plant-text">environment </span>
					</div>
				</div>
			</div>
			<div class="tag-slider wow fadeInUp" data-wow-delay="0.4s" id="tagSlider2">
				<div class="item-wrap">
					<div class="item">
						<span class="plant-text">plant</span>
					</div>
					<div class="item">
						<span class="plant-text">be</span>
					</div>
					<div class="item">
						<span class="plant-text">green </span>
					</div>
					<div class="item">
						<span class="plant-text">plant</span>
					</div>
					<div class="item">
						<span class="plant-text">be</span>
					</div>
					<div class="item">
						<span class="plant-text">green </span>
					</div>
					<div class="item">
						<span class="plant-text">plant</span>
					</div>
					<div class="item">
						<span class="plant-text">be</span>
					</div>
					<div class="item">
						<span class="plant-text">green </span>
					</div>
				</div>
			</div>
		</div>
	</section>

        <!--images section -->
	<div class="content-inner bg-light">
		<div class="container-fluid">
			<div class="gallery-wrapper" id="lightgallery">
				<div class="gallery-col">
					<div class="gallery-item m-b30">
						<div class="dz-box post-1 box-hover">
							<a href="images/gallery/pic1.png" data-src="images/gallery/pic1.png" class="dz-media lg-item">
								<img src="images/gallery/pic1.png"  alt="/">
								<span class="view-btn lightimg"></span>
							</a>
						</div>
					</div>
					<div class="gallery-item m-b30">
						<div class="dz-box post-2 box-hover">
							<a href="images/gallery/pic2.png" data-src="images/gallery/pic2.png" class="dz-media lg-item">
								<img src="images/gallery/pic2.png"  alt="/">
								<span class="view-btn lightimg"></span>
							</a>
						</div>
					</div>
					<div class="gallery-item">
						<div class="dz-box post-3 box-hover">
							<a href="images/gallery/pic3.png" data-src="images/gallery/pic3.png" class="dz-media lg-item">
								<img src="images/gallery/pic3.png"  alt="/">
								<span class="view-btn lightimg"></span>
							</a>
						</div>
					</div>
					<div class="gallery-item">
						<div class="dz-box post-4 box-hover">
							<a href="images/gallery/pic4.png" data-src="images/gallery/pic4.png" class="dz-media lg-item">
								<img src="images/gallery/pic4.png"  alt="/">
								<span class="view-btn lightimg"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="gallery-col-2">
					<div class="gallery-item">
						<div class="dz-box post-5 box-hover">
							<a href="images/gallery/pic5.png" data-src="images/gallery/pic5.png" class="dz-media lg-item">
								<img src="images/gallery/pic5.png"  alt="/">
								<span class="view-btn lightimg"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="gallery-col">
					<div class="gallery-item m-b30">
						<div class="dz-box post-6 box-hover">
							<a href="images/gallery/pic6.png" data-src="images/gallery/pic6.png" class="dz-media lg-item">
								<img src="images/gallery/pic6.png"  alt="/">
								<span class="view-btn lightimg"></span>
							</a>
						</div>
					</div>
					<div class="gallery-item m-b30">
						<div class="dz-box post-7 box-hover">
							<a href="images/gallery/pic7.png" data-src="images/gallery/pic7.png" class="dz-media lg-item">
								<img src="images/gallery/pic7.png"  alt="/">
								<span class="view-btn lightimg"></span>
							</a>
						</div>
					</div>
					<div class="gallery-item">
						<div class="dz-box post-8 box-hover">
							<a href="images/gallery/pic8.png" data-src="images/gallery/pic8.png" class="dz-media lg-item">
								<img src="images/gallery/pic8.png"  alt="/">
								<span class="view-btn lightimg"></span>
							</a>
						</div>
					</div>
					<div class="gallery-item">
						<div class="dz-box post-9 box-hover">
							<a href="images/gallery/pic9.png" data-src="images/gallery/pic9.png" class="dz-media lg-item">
								<img src="images/gallery/pic9.png"  alt="/">
								<span class="view-btn lightimg"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
        <!--images section End-->


        <!-- Products  Section Start-->
	<section class="content-inner">
		<div class="container">
			<div class=" row text-center m-auto">
				<div class="col-lg-12 col-md-12">
					<div class="section-head style-1 m-b30  wow fadeInUp" data-wow-delay="0.2s">
						<div class="left-content">
							<h2 class="title">Most popular products</h2>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-12">
					<div class="site-filters clearfix  align-items-center wow fadeInUp m-b50" data-wow-delay="0.4s">
						<ul class="filters" data-bs-toggle="buttons">
							<li class="btn active">
								<input type="radio">
								<a href="javascript:void(0);">Trees</a>
							</li>
							<li data-filter=".shrubs" class="btn">
								<input type="radio">
								<a href="javascript:void(0);">Shrubs</a>
							</li>
							<li data-filter=".herbs" class="btn">
								<input type="radio">
								<a href="javascript:void(0);">Herbs</a>
							</li>
							<li data-filter=".vines" class="btn">
								<input type="radio">
								<a href="javascript:void(0);">Vines</a>
							</li>
							<li data-filter=".ferns" class="btn">
								<input type="radio">
								<a href="javascript:void(0);">Ferns</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="clearfix">
				<ul id="masonry" class="row g-xl-4 g-3">
					<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 herbs wow fadeInUp" data-wow-delay="0.6s">
						<div class="shop-card ">
							<div class="dz-media">
								<img src="images/shop/product/1.png" alt="image">
								<div class="shop-meta">

									<div class="btn btn-primary meta-icon dz-wishicon">
										<i class="icon feather icon-heart dz-heart"></i>
										<i class="icon feather icon-heart-on dz-heart-fill"></i>
									</div>
									<a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
										<i class="flaticon flaticon-eye d-md-none d-block"></i>
										<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
									</a>
									<div class="btn btn-primary meta-icon dz-carticon">
										<i class="flaticon flaticon-basket"></i>
										<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
									</div>
								</div>
							</div>
							<div class="dz-content">
								<h2 class="title"><a href="shop-list.html">Vineyard Reach (m)</a></h2>
								<span class="price">
									$1099
									<del>$659</del>
								</span>
							</div>
						</div>
					</li>
					<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 shrubs ferns wow fadeInUp" data-wow-delay="0.8s">
						<div class="shop-card ">
							<div class="dz-media">
								<img src="images/shop/product/2.png" alt="image">
								<div class="shop-meta">

									<div class="btn btn-primary meta-icon dz-wishicon">
										<i class="icon feather icon-heart dz-heart"></i>
										<i class="icon feather icon-heart-on dz-heart-fill"></i>
									</div>
									<a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
										<i class="flaticon flaticon-eye d-md-none d-block"></i>
										<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
									</a>
									<div class="btn btn-primary meta-icon dz-carticon">
										<i class="flaticon flaticon-basket"></i>
										<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
									</div>
								</div>
							</div>
							<div class="dz-content">
								<h2 class="title"><a href="shop-list.html">TallS talk Gardens (m)</a></h2>
								<span class="price">
									<del>$659</del>
									$1099
								</span>
							</div>
						</div>
					</li>
					<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 shrubs wow fadeInUp" data-wow-delay="1.0s">
						<div class="shop-card ">
							<div class="dz-media">
								<img src="images/shop/product/3.png" alt="image">
								<div class="shop-meta">

									<div class="btn btn-primary meta-icon dz-wishicon">
										<i class="icon feather icon-heart dz-heart"></i>
										<i class="icon feather icon-heart-on dz-heart-fill"></i>
									</div>
									<a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
										<i class="flaticon flaticon-eye d-md-none d-block"></i>
										<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
									</a>
									<div class="btn btn-primary meta-icon dz-carticon">
										<i class="flaticon flaticon-basket"></i>
										<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
									</div>
								</div>
							</div>
							<div class="dz-content">
								<h2 class="title"><a href="shop-list.html">Endless Stems Gardens (m)</a></h2>
								<span class="price">
									<del>$659</del>
									$1099
								</span>
							</div>
						</div>
					</li>
					<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 herbs ferns wow fadeInUp" data-wow-delay="1.2s">
						<div class="shop-card ">
							<div class="dz-media">
								<img src="images/shop/product/4.png" alt="image">
								<div class="shop-meta">

									<div class="btn btn-primary meta-icon dz-wishicon">
										<i class="icon feather icon-heart dz-heart"></i>
										<i class="icon feather icon-heart-on dz-heart-fill"></i>
									</div>
									<a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
										<i class="flaticon flaticon-eye d-md-none d-block"></i>
										<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
									</a>
									<div class="btn btn-primary meta-icon dz-carticon">
										<i class="flaticon flaticon-basket"></i>
										<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
									</div>
								</div>
							</div>
							<div class="dz-content">
								<h2 class="title"><a href="shop-list.html">Long Vine Flora (m)</a></h2>
								<span class="price">
									<del>$659</del>
									$1099
								</span>
							</div>
						</div>
					</li>
					<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 shrubs wow fadeInUp" data-wow-delay="0.2s">
						<div class="shop-card ">
							<div class="dz-media">
								<img src="images/shop/product/5.png" alt="image">
								<div class="shop-meta">

									<div class="btn btn-primary meta-icon dz-wishicon">
										<i class="icon feather icon-heart dz-heart"></i>
										<i class="icon feather icon-heart-on dz-heart-fill"></i>
									</div>
									<a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
										<i class="flaticon flaticon-eye d-md-none d-block"></i>
										<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
									</a>
									<div class="btn btn-primary meta-icon dz-carticon">
										<i class="flaticon flaticon-basket"></i>
										<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
									</div>
								</div>
							</div>
							<div class="dz-content">
								<h2 class="title"><a href="shop-list.html">Long Vine Flora (m)</a></h2>
								<span class="price">
									<del>$659</del>
									$1099
								</span>
							</div>
						</div>
					</li>
					<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 vines wow fadeInUp" data-wow-delay="0.4s">
						<div class="shop-card ">
							<div class="dz-media">
								<img src="images/shop/product/6.png" alt="image">
								<div class="shop-meta">

									<div class="btn btn-primary meta-icon dz-wishicon">
										<i class="icon feather icon-heart dz-heart"></i>
										<i class="icon feather icon-heart-on dz-heart-fill"></i>
									</div>
									<a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
										<i class="flaticon flaticon-eye d-md-none d-block"></i>
										<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
									</a>
									<div class="btn btn-primary meta-icon dz-carticon">
										<i class="flaticon flaticon-basket"></i>
										<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
									</div>
								</div>
							</div>
							<div class="dz-content">
								<h2 class="title"><a href="shop-list.html">Bacopa sutera cordata (m)</a></h2>
								<span class="price">
									<del>$659</del>
									$1099
								</span>
							</div>
						</div>
					</li>
					<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 shrubs wow fadeInUp" data-wow-delay="0.6s">
						<div class="shop-card ">
							<div class="dz-media">
								<img src="images/shop/product/7.png" alt="image">
								<div class="shop-meta">

									<div class="btn btn-primary meta-icon dz-wishicon">
										<i class="icon feather icon-heart dz-heart"></i>
										<i class="icon feather icon-heart-on dz-heart-fill"></i>
									</div>
									<a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
										<i class="flaticon flaticon-eye d-md-none d-block"></i>
										<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
									</a>
									<div class="btn btn-primary meta-icon dz-carticon">
										<i class="flaticon flaticon-basket"></i>
										<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
									</div>
								</div>
							</div>
							<div class="dz-content">
								<h2 class="title"><a href="shop-list.html">Towering Twigs Botanicals (m)</a></h2>
								<span class="price">
									<del>$659</del>
									$1099
								</span>
							</div>
						</div>
					</li>
					<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 herbs wow fadeInUp" data-wow-delay="2.0s">
						<div class="shop-card ">
							<div class="dz-media">
								<img src="images/shop/product/8.png" alt="image">
								<div class="shop-meta">

									<div class="btn btn-primary meta-icon dz-wishicon">
										<i class="icon feather icon-heart dz-heart"></i>
										<i class="icon feather icon-heart-on dz-heart-fill"></i>
									</div>
									<a href="javascript:void(0);" class="btn btn-primary meta-icon dz-wishicon" data-bs-toggle="modal" data-bs-target="#exampleModal">
										<i class="flaticon flaticon-eye d-md-none d-block"></i>
										<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
									</a>
									<div class="btn btn-primary meta-icon dz-carticon">
										<i class="flaticon flaticon-basket"></i>
										<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
									</div>
								</div>
							</div>
							<div class="dz-content">
								<h2 class="title"><a href="shop-list.html">Large Majesty
									Palm (m)</a></h2>
								<span class="price">
									$1099
									<del>$659</del>
								</span>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</section>
        <!-- Products Section Start-->

        <!-- Blog Start -->
		<section class="content-inner overflow-hidden p-t0">
			<div class="container">
				<div class="row justify-content-between align-items-center">
					<div class="col-lg-6 col-md-8 col-sm-12">
						<div class="section-head style-1 wow fadeInUp" data-wow-delay="0.1s" >
							<div class="left-content">
								<h2 class="title">Latest Plant News</h2>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-4 col-sm-12 text-md-end m-b30 wow fadeInUp" data-wow-delay="0.2s" >
						<a class="btn btn-outline-secondary m-b30" href="post-standard.html">View All</a>
					</div>
				</div>
			</div>
			<div class="swiper swiper-blog-post">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.2s">
							<div class="dz-media">
								<img src="images/blog/grid/1.jpg" alt="">
								<div class="post-date">17 May 2022</div>
							</div>
							<div class="dz-info">
								<h3 class="dz-title mb-0">
									<a href="blog-light-3-column.html">Insights into Plant Care & Cultivation</a>
								</h3>
								<ul class="blog-social">
									<li>
										<a class="share-btn" href="javascript:void(0);">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M7 17L17 7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M7 7H17V17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</a>
										<ul class="sub-team-social">
											<li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
											<li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
											<li><a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.4s">
							<div class="dz-media">
								<img src="images/blog/grid/2.jpg" alt="">
								<div class="post-date">16 May 2022</div>
							</div>
							<div class="dz-info">
								<h3 class="dz-title mb-0">
									<a href="blog-light-3-column.html">Exploring the World of Plants Stories</a>
								</h3>
								<ul class="blog-social">
									<li>
										<a class="share-btn" href="javascript:void(0);">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M7 17L17 7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M7 7H17V17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</a>
										<ul class="sub-team-social">
											<li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
											<li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
											<li><a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.6s">
							<div class="dz-media">
								<img src="images/blog/grid/3.jpg" alt="">
								<div class="post-date">07 JuN 2022</div>
							</div>
							<div class="dz-info">
								<h3 class="dz-title mb-0">
									<a href="blog-light-3-column.html">Stories from the Plant Kingdom</a>
								</h3>
								<ul class="blog-social">
									<li>
										<a class="share-btn" href="javascript:void(0);">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M7 17L17 7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M7 7H17V17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</a>
										<ul class="sub-team-social">
											<li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
											<li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
											<li><a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.8s">
							<div class="dz-media">
								<img src="images/blog/grid/4.jpg" alt="">
								<div class="post-date">02 FEB 2022</div>
							</div>
							<div class="dz-info">
								<h3 class="dz-title mb-0">
									<a href="blog-light-3-column.html">All About Plants and Gardens Corner</a>
								</h3>
								<ul class="blog-social">
									<li>
										<a class="share-btn" href="javascript:void(0);">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M7 17L17 7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M7 7H17V17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</a>
										<ul class="sub-team-social">
											<li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
											<li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
											<li><a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="1.0s">
							<div class="dz-media">
								<img src="images/blog/grid/5.jpg" alt="">
								<div class="post-date">17 May 2022</div>
							</div>
							<div class="dz-info">
								<h3 class="dz-title mb-0">
									<a href="blog-light-3-column.html">Nurturing Your Passion for Plants</a>
								</h3>
								<ul class="blog-social">
									<li>
										<a class="share-btn" href="javascript:void(0);">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M7 17L17 7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												<path d="M7 7H17V17" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</a>
										<ul class="sub-team-social">
											<li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
											<li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
											<li><a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
        <!-- Blog End -->

        <!-- Newsletter Start-->
	<section class="content-inner-1  overflow-hidden position-relative border-top">
		<div class="collection1 style-1 up-down"><img src="images/collection/1.png" alt=""></div>
		<div class="collection3 style-1 up-down"><img src="images/collection/2.png"  alt=""></div>
		<div class="container">
			<div class="section-head style-1 d-block wow fadeInUp text-center" data-wow-delay="0.1s">
				<div class="max-w900 mx-auto">
					<h2 class="title mb-4">Subscribe Newsletter & Get Plant News</h2>
				</div>
			</div>
			<form class="dzSubscribe style-2" action="script/mailchamp.php" method="post">
				<div class="dzSubscribeMsg"></div>
				<div class="form-group">
					<div class="input-group mb-0">
						<input name="dzEmail" required="required" type="email" class="form-control h-70" placeholder="Your Email Address">
						<div class="sub-btn">
							<button name="submit" value="Submit" type="submit" class="btn btn-secondary">Subscribe Now</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
        <!-- Newsletter End -->

        <!-- Feature Box -->
	<div class="content-inner py-0  image-wrapper">
		<div class="container-fluid px-0">
			<div class="row gx-0">
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.1s">
					<div class="insta-post dz-media box-hover">
						<img src="images/plants/feature/1.png" alt="">
						<a href="https://www.instagram.com/dexignzone/" class="instagram-link" target="_blank">
							<div class="follow-link" >
								<div class="follow-link-icon">
									<img src="images/insta-follow.png" alt="">
								</div>
								<div class="follow-link-content">
									<h6>Share with #PlantZone</h6>
									<p class="m-0">Follow <span>@PlantZone </span>for inspiration.</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.2s">
					<div class="insta-post dz-media box-hover">
						<img src="images/plants/feature/2.png" alt="">
						<a href="https://www.instagram.com/dexignzone/" class="instagram-link" target="_blank">
							<div class="follow-link" >
								<div class="follow-link-icon">
									<img src="images/insta-follow.png" alt="">
								</div>
								<div class="follow-link-content">
									<h6>Share with #PlantZone</h6>
									<p class="m-0">Follow <span>@PlantZone </span>for inspiration.</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.3s">
					<div class="insta-post dz-media box-hover">
						<img src="images/plants/feature/3.png" alt="">
						<a href="https://www.instagram.com/dexignzone/" class="instagram-link" target="_blank">
							<div class="follow-link" >
								<div class="follow-link-icon">
									<img src="images/insta-follow.png" alt="">
								</div>
								<div class="follow-link-content">
									<h6>Share with #PlantZone</h6>
									<p class="m-0">Follow <span>@PlantZone </span>for inspiration.</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.4s">
					<div class="insta-post dz-media box-hover">
						<img src="images/plants/feature/4.png" alt="">
						<a href="https://www.instagram.com/dexignzone/" class="instagram-link" target="_blank">
							<div class="follow-link" >
								<div class="follow-link-icon">
									<img src="images/insta-follow.png" alt="">
								</div>
								<div class="follow-link-content">
									<h6>Share with #PlantZone</h6>
									<p class="m-0">Follow <span>@PlantZone </span>for inspiration.</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.5s">
					<div class="insta-post dz-media box-hover">
						<img src="images/plants/feature/5.png" alt="">
						<a href="https://www.instagram.com/dexignzone/" class="instagram-link" target="_blank">
							<div class="follow-link" >
								<div class="follow-link-icon">
									<img src="images/insta-follow.png" alt="">
								</div>
								<div class="follow-link-content">
									<h6>Share with #PlantZone</h6>
									<p class="m-0">Follow <span>@PlantZone </span>for inspiration.</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-4 wow fadeIn" data-wow-delay="0.6s">
					<div class="insta-post dz-media box-hover">
						<img src="images/plants/feature/6.png" alt="">
						<a href="https://www.instagram.com/dexignzone/" class="instagram-link" target="_blank">
							<div class="follow-link" >
								<div class="follow-link-icon">
									<img src="images/insta-follow.png" alt="">
								</div>
								<div class="follow-link-content">
									<h6>Share with #PlantZone</h6>
									<p class="m-0">Follow <span>@PlantZone </span>for inspiration.</p>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
        <!-- Feature Box End -->

	</div>

@endsection


@section('site-scripts')
    @parent

@endsection
