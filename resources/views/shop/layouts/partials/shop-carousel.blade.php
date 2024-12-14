					<div class="col-80 col-xl-9">
						<h2 class="mb-3">Category</h2>
						<div class="row">
							<div class="col-xl-12">
								<div class="swiper category-swiper">
									<div class="swiper-wrapper">
										<div class="swiper-slide">
											<div class="shop-card">
												<div class="dz-media rounded">
													<img src="{{ asset('assets/images/shop/product/1.png') }}" alt="image">
												</div>
												<div class="dz-content">
													<h2 class="title"><a href="shop-list.html">Bonsai</a></h2>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="shop-card">
												<div class="dz-media rounded">
													<img src="{{ asset('assets/images/shop/product/3.png') }}" alt="image">
												</div>
												<div class="dz-content">
													<h2 class="title"><a href="shop-list.html">House Plants</a></h2>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="shop-card">
												<div class="dz-media rounded">
													<img src="{{ asset('assets/images/shop/product/4.png') }}" alt="image">
												</div>
												<div class="dz-content">
													<h2 class="title"><a href="shop-list.html">Perennials</a></h2>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="shop-card">
												<div class="dz-media rounded">
													<img src="{{ asset('assets/images/shop/product/2.png') }}" alt="image">
												</div>
												<div class="dz-content">
													<h2 class="title"><a href="shop-list.html">Plant For Gift</a></h2>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="shop-card">
												<div class="dz-media rounded">
													<img src="{{ asset('assets/images/shop/product/3.png') }}" alt="image">
												</div>
												<div class="dz-content">
													<h2 class="title"><a href="shop-list.html">Best Sellers</a></h2>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="shop-card">
												<div class="dz-media rounded">
													<img src="{{ asset('assets/images/shop/product/4.png') }}" alt="image">
												</div>
												<div class="dz-content">
													<h2 class="title"><a href="shop-list.html">Blossom Haven</a></h2>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="shop-card">
												<div class="dz-media rounded">
													<img src="{{ asset('assets/images/shop/product/2.png') }}" alt="image">	
												</div>
												<div class="dz-content">
													<h2 class="title"><a href="shop-list.html">Small Plants</a></h2>
												</div>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="shop-card">
												<div class="dz-media rounded">
													<img src="{{ asset('assets/images/shop/product/4.png') }}" alt="image">	
												</div>
												<div class="dz-content">
													<h2 class="title"><a href="shop-list.html">Bonsai</a></h2>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						@include('shop.layouts.partials.main-filter')

						@include('shop.layouts.partials.main-products')
												
						@include('shop.layouts.partials.main-paginate')
					</div>