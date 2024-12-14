@extends('shop.layouts.cart')

@section('title', 'Cart')

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
								<li class="breadcrumb-item">Shop Cart</li>
							</ul>
						</nav>
					</div>
				</div>	
			</div>
			<!--Banner End-->

			
			<!-- contact area -->
			<section class="content-inner shop-account">
				<!-- Product -->
				<div class="container">
					<div class="row">
						<div class="col-lg-8">
							<div class="table-responsive">
								<table class="table check-tbl">
									<thead>
										<tr>
											<th></th>
											<th></th>
											<th>Product</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="product-item-close"><a href="javascript:void(0);"><i class="ti-close"></i></a></td>
											<td class="product-item-img"><img src="{{ asset('assets/images/shop/shop-cart/pic1.jpg') }}" alt="/"></td>
											<td class="product-item-name">Indoor Oasis Lush Ble...</td>
											<td class="product-item-price">$40.00</td>
											<td class="product-item-quantity">
												<div class=" quantity btn-quantity style-1">
													<input id="demo_vertical2" type="text" value="1" name="demo_vertical2">
												</div>
											</td>
											<td class="product-item-totle">$160.00</td>		
										</tr>
										<tr>
											<td class="product-item-close"><a href="javascript:void(0);"><i class="ti-close"></i></a></td>	
											<td class="product-item-img"><img src="{{ asset('assets/images/shop/shop-cart/pic2.jpg') }}" alt="/"></td>
											<td class="product-item-name">TallStalk Gardens Ble...</td>
											<td class="product-item-price">$56.00</td>
											<td class="product-item-quantity">
												<div class="quantity btn-quantity style-1">
													<input id="demo_vertical3" type="text" value="1" name="demo_vertical2">
												</div>
											</td>
											<td class="product-item-totle">$120.00</td>
										</tr>
										<tr>
											<td class="product-item-close"><a href="javascript:void(0);"><i class="ti-close"></i></a></td>
											<td class="product-item-img"><img src="{{ asset('assets/images/shop/shop-cart/pic3.jpg') }}" alt="/"></td>
											<td class="product-item-name">Rosa genus & the species...</td>
											<td class="product-item-price">$30.00</td>
											<td class="product-item-quantity">
												<div class="quantity btn-quantity style-1">
													<input id="demo_vertical4" type="text" value="1" name="demo_vertical2">
												</div>
											</td>
											<td class="product-item-totle">$40.00</td>										
										</tr>
										<tr>
											<td class="product-item-close"><a href="javascript:void(0);"><i class="ti-close"></i></a></td>
											<td class="product-item-img"><img src="{{ asset('assets/images/shop/shop-cart/pic4.jpg') }}" alt="/"></td>
											<td class="product-item-name">Stretching Vine Nursery... </td>
											<td class="product-item-price">$42.00</td>
											<td class="product-item-quantity">
												<div class="quantity btn-quantity style-1">
													<input id="demo_vertical5" type="text" value="1" name="demo_vertical2">
												</div>
											</td>
											<td class="product-item-totle">$160.00</td>
										</tr>
										<tr>
											<td class="product-item-close"><a href="javascript:void(0);"><i class="ti-close"></i></a></td>
											<td class="product-item-img"><img src="{{ asset('assets/images/shop/shop-cart/pic5.jpg') }}" alt="/"></td>
											<td class="product-item-name">Extended Roots Gardens...</td>
											<td class="product-item-price">$28.00</td>
											<td class="product-item-quantity">
												<div class="quantity btn-quantity style-1">
													<input id="demo_vertical6" type="text" value="1" name="demo_vertical2">
												</div>
											</td>
											<td class="product-item-totle">$45.00</td>									
										</tr>
										<tr>
											<td class="product-item-close"><a href="javascript:void(0);"><i class="ti-close"></i></a></td>
											<td class="product-item-img"><img src="{{ asset('assets/images/shop/shop-cart/pic6.jpg') }}" alt="/"></td>
											<td class="product-item-name">Towering Twigs Botanicals...</td>
											<td class="product-item-price">$120.00</td>
											<td class="product-item-quantity">
												<div class="quantity btn-quantity style-1">
													<input id="demo_vertical7" type="text" value="1" name="demo_vertical2">
												</div>
											</td>
											<td class="product-item-totle">$40.00</td>									
										</tr>
									</tbody>
								</table>
							</div>
							<div class="row shop-form m-t30 align-items-center">
								<div class="col-xl-6 col-lg-12 col-sm-12 m-b30 m-xl-0">
									<div class="custom-control custom-checkbox d-flex align-items-center">
										<input type="checkbox" class="form-check-input" id="basic_checkbox_01">
										<label class="form-check-label  text-secondary" for="basic_checkbox_01">Gift Wrap Your Purchase For Just Rs.500.00</label>
									</div>
								</div>
								<div class="col-xl-6 col-lg-12 text-start text-xl-end col-sm-12">
									<a href="shop-cart.html" class="btn btn-outline-secondary ">Restore To Store</a>
									<a href="shop-cart.html" class="btn btn-secondary">Empty Cart</a>
								</div>
								<div class="col-md-12 m-tb40">
									<div class="form-group">
										<label class="label-title">Order Special Instructions</label>
										<textarea id="comments" placeholder="Write Your instructions..." class="form-control" name="comment" cols="90" rows="8" required="required"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="cart-detail">
								<a href="javascript:void(0);" class="btn btn-outline-secondary w-100 m-b20 btn-lg">Bank Offer 5% Cashback</a>
								<div class="icon-bx-wraper style-4 m-b15">
									<div class="icon-bx">
										<i class="flaticon flaticon-ship"></i>
									</div>
									<div class="icon-content">
										<span class=" font-13">Free</span>
										<h6 class="dz-title">Shipping</h6>
									</div>
								</div>
								<div class="icon-bx-wraper style-4 m-b30">
									<div class="icon-bx">
										<img src="{{ asset('assets/images/shop/shop-cart/icon-box/pic2.png') }}" alt="/">
									</div>
									<div class="icon-content">
										<h6 class="dz-title">Enjoy The Product</h6>
										<p>Lorem Ipsum is simply dummy text of the printing </p>
									</div>
								</div>
								<div class="save-text">
									<i class="icon feather icon-check-circle"></i>
									<span class="m-l10">You will save<span>₹504</span> on this order</span>
								</div>
								<table>
									<tbody>
										<tr class="total">
											<td>
												<h6 class="mb-0">Total Amount</h6>
											</td>
											<td class="price">
												$125.75
											</td>
										</tr>
									</tbody>
								</table>
								<a href="shop-checkout.html" class="btn btn-outline-secondary w-100 btn-lg">PLACE ORDER</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Product END -->
			</section>
			<!-- contact area End--> 

			<!-- Newsletter Start-->
			<section class="content-inner-3  overflow-hidden position-relative border-top">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 col-md-12">
							<div class="section-head style-2 d-block wow fadeInUp" data-wow-delay="0.2s">
								<h2 class="title mb-4">Subscribe Newsletter & Get Plant News</h2>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 m-b30 wow fadeInUp" data-wow-delay="0.4s">
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
					</div>
				</div>
			</section>
		    <!-- Newsletter End -->
@endsection

@section('scripts')
	@parent

@endsection