@extends('shop.layouts.cart')

@section('title', 'Checkout')

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
							<li class="breadcrumb-item">Shop Checkout</li>
						</ul>
					</nav>
				</div>
			</div>	
		</div>
		<!--Banner End-->

		<!-- inner page banner End-->
		<div class="content-inner-1">
			<div class="container">
				<div class="row shop-checkout">
					<div class="col-xl-8">
						<div class="d-sm-flex justify-content-between"> 
							<h2 class="title m-b15 text-capitalize">Billing details</h2>
							<span class="text-black font-14 font-weight-500 m-sm-0 m-b20 d-block">Secure <a class="text-primary primary border-bottom" href="login.html">login</a> & easy <a class="text-primary primary border-bottom" href="registration.html">registration</a> for seamless access.</span>
						</div>
						<div class="accordion dz-accordion accordion-sm" id="accordionFaq">
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingOne">
									<a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										Returning customer? <span class="text-primary m-l5">  Click here to login</span>
										<span class="toggle-close"></span>
									</a>
								</h2>
								<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionFaq">
									<div class="accordion-body">
										<p class="m-b0">If your order has not yet shipped, you can contact us to change your shipping address</p>
									</div>
								</div>
							</div>
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingTwo">
									<a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
										Have a coupon? <span class="text-primary m-l5"> Click here to enter your code </span>
										<span class="toggle-close"></span>
									</a>
								</h2>
								<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFaq">
									<div class="accordion-body">
										<p class="m-b0">If your order has not yet shipped, you can contact us to change your shipping address</p>
									</div>
								</div>
							</div>
						</div>
						<form class="row">
							<div class="col-md-6">
								<div class="form-group m-b15">
									<label class="label-title">First Name</label>
									<input name="dzName" required="" class="form-control" placeholder="First Name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group m-b15">
									<label class="label-title">Last Name</label>
									<input name="dzName" required="" class="form-control" placeholder="Last Name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group m-b15">
									<label class="label-title">Email</label>
									<input name="dzEmail" required="" class="form-control" placeholder="Email Address">
								</div>
							</div>
							<div class="col-md-6">
								<label class="label-title">Phone Number</label>
								<div class=" form-group input-group mb-3 style-1">
									<button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">IN</button>
									<ul class="dropdown-menu">
									  <li><a class="dropdown-item" href="#">IN</a></li>
									  <li><a class="dropdown-item" href="#">AUG</a></li>
									  <li><a class="dropdown-item" href="#">newyork</a></li>
									  <li><a class="dropdown-item" href="#">america</a></li>
									</ul>
									<input name="dzEmail" type="number" required="" class="form-control" placeholder="+91 (0) 123 456 789">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group m-b15">
									<label class="label-title">Company name (optional)</label>
									<input name="dzName" required="" class="form-control" placeholder="Company Name">
								</div>
							</div>
							<div class="col-md-12">
								<div class="m-b25">
									<label class="label-title">Country / Region *</label>
									<div class="form-select">
										<select class="default-select w-100">
											<option selected>India</option>
											<option value="1">Another option</option>
											<option value="2">UK</option>
											<option value="3">Iraq</option>
										</select>	
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group m-b15">
									<label class="label-title">Street address *</label>
									<input name="dzName" required="" class="form-control m-b15" placeholder="House number and street name">
									<input name="dzName" required="" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group m-b15">
									<label class="label-title">Pin Code*</label>
									<input name="number" type="number"  required="" class="form-control">
								</div>
							</div>
							<div class="col-md-12">
								<div class="m-b15">
									<label class="label-title">Town / City *</label>
									<div class="form-select">
										<select class="default-select w-100">
											<option selected>Kota</option>
											<option value="1">Another option</option>
											<option value="2">Jaipur</option>
											<option value="3">Udaipur</option>
										</select>	
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="m-b15">
									<label class="label-title">State *</label>
									<div class="form-select">
										<select class="default-select w-100">
											  <option selected>Rajasthan</option>
											  <option value="1">Another option</option>
											  <option value="2">Rajasthan</option>
											  <option value="3">Rajasthan</option>
										</select>	
									</div>
								</div>
							</div>
							<div class="col-md-12 m-b15">
								<div class="form-group m-b5">
								   <div class="custom-control custom-checkbox">
										<input type="checkbox" class="form-check-input" id="basic_checkbox_01">
										<label class="form-check-label" for="basic_checkbox_01">Ship To a Different Address? </label>
									</div>
								</div>
							</div>
							<div class="col-md-12 m-b40">
								<div class="form-group">
									<label class="label-title">Order notes (optional)</label>
									<textarea id="comments" placeholder="Notes about your order, e.g. special notes for delivery." class="form-control" name="comment" cols="90" rows="5" required="required"></textarea>
								</div>
							</div>
							<div class="col-md-12 ">
								<h4 class="title m-b15 text-capitalize">Shipping Methods</h4>
							</div>
							<div class="col-md-6">
								<div class="custom-control style-1">
									<input class="form-check-input radio" type="radio" name="Methods1" id="Methods1">
									<label class="custom-checkbox form-check-label" for="Methods1">
										<img src="{{ asset('assets/images/shop/payment/fedex.svg') }}" alt="/">
										<span>
											<span class="title">FedEx,</span>
											<span class="text">Delivery, Tomorrow</span>
										</span>
										<span class="price">$0.99</span>
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="custom-control style-1">
									<input class="form-check-input radio" type="radio" name="Methods1" id="Methods2">
									<label class="custom-checkbox form-check-label" for="Methods2">
										<img src="{{ asset('assets/images/shop/payment/american.svg') }}" alt="/">
										<span>
											<span class="title">American</span>
											<span class="text">Delivery, Today</span>
										</span>
										<span class="price">$0.99</span>
									</label>
								</div>
							</div>
							<div class="col-md-6  m-b40">
								<div class="custom-control style-1">
									<input class="form-check-input radio" type="radio" name="Methods1" id="Methods3">
									<label class="custom-checkbox form-check-label" for="Methods3">
										<img src="{{ asset('assets/images/shop/payment/dhl.svg') }}" alt="/">
										<span>
											<span class="title">DHL Express</span>
											<span class="text">Delivery, Today</span>
										</span>
										<span class="price">$0.99</span>
									</label>
								</div>
							</div>
							<div class="col-md-6  m-b40">
								<div class="custom-control style-1">
									<input class="form-check-input radio" type="radio" name="Methods1" id="Methods4">
									<label class="custom-checkbox form-check-label" for="Methods4">
										<img src="{{ asset('assets/images/shop/payment/retrieve.svg') }}" alt="/">
										<span>
											<span class="title">DHL Express</span>
											<span class="text">Delivery, Today</span>
										</span>
										<span class="price">$0.99</span>
									</label>
								</div>
							</div>
							<div class="col-md-12 ">
								<h2 class="title m-b15 text-capitalize">Payment Methods</h2>
							</div>
							<div class="col-md-6">
								<div class="custom-control style-1">
									<input class="form-check-input radio" type="radio" name="Methods1" id="Methods5">
									<label class="custom-checkbox form-check-label payment" for="Methods5">
										<img src="{{ asset('assets/images/shop/payment/paypal.svg') }}" alt="/">
										<span>
											<span class="title">Paypal</span>
										</span>
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="custom-control style-1">
									<input class="form-check-input radio" type="radio" name="Methods1" id="Methods6">
									<label class="custom-checkbox form-check-label payment" for="Methods6">
										<img src="{{ asset('assets/images/shop/payment/debit.svg') }}" alt="/">
										<span>
											<span class="title">Credit or Debit Card</span>
										</span>
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="custom-control style-1">
									<input class="form-check-input radio" type="radio" name="Methods1" id="Methods7">
									<label class="custom-checkbox form-check-label payment" for="Methods7">
										<img src="{{ asset('assets/images/shop/payment/bank.svg') }}" alt="/">
										<span>
											<span class="title">Direct bank Transfer</span>
										</span>
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="custom-control style-1">
									<input class="form-check-input radio" type="radio" name="Methods1" id="Methods8">
									<label class="custom-checkbox form-check-label payment" for="Methods8">
										<img src="{{ asset('assets/images/shop/payment/cash.svg') }}" alt="/">
										<span>
											<span class="title">Cash on Delivery</span>
										</span>
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Card Number</label>
									<input type="number" name="dzNumber" required="" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-6">
										<div class="form-group m-b25">
											<label class="label-title">Expiry Date</label>
											<input type="date" required="" class="form-control" aria-label="calendar outline">
										</div>
									</div>
									<div class="col-6">
										<div class="form-group m-b25">
											<label class="label-title">CVC/CVV</label>
											<input type="number" required=""  class="form-control"   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
										</div>
									</div>
								</div>
							</div>
							<a class="d-flex align-items-center" href="javascript:void(0)">
								<span class="m-r5">
									<svg width="18" height="18" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14.0625 6.60938H12.7956V3.71848C12.7956 1.66809 11.0923 0 8.9987 0C6.90511 0 5.20182 1.66809 5.20182 3.71848V6.60938H3.9375C2.77439 6.60938 1.82812 7.55564 1.82812 8.71875V15.8906C1.82812 17.0537 2.77439 18 3.9375 18H14.0625C15.2256 18 16.1719 17.0537 16.1719 15.8906V8.71875C16.1719 7.55564 15.2256 6.60938 14.0625 6.60938ZM6.60807 3.71848C6.60807 2.4435 7.68052 1.40625 8.9987 1.40625C10.3169 1.40625 11.3893 2.4435 11.3893 3.71848V6.60938H6.60807V3.71848ZM14.7656 15.8906C14.7656 16.2783 14.4502 16.5938 14.0625 16.5938H3.9375C3.5498 16.5938 3.23438 16.2783 3.23438 15.8906V8.71875C3.23438 8.33105 3.5498 8.01562 3.9375 8.01562H14.0625C14.4502 8.01562 14.7656 8.33105 14.7656 8.71875V15.8906Z" fill="#686868"/>
									<path d="M9 10.0547C8.28158 10.0547 7.69922 10.6371 7.69922 11.3555C7.69922 11.8142 7.93687 12.2171 8.29557 12.4488V13.9922C8.29557 14.3805 8.61036 14.6953 8.9987 14.6953C9.387 14.6953 9.70182 14.3805 9.70182 13.9922V12.4504C10.062 12.2191 10.3008 11.8153 10.3008 11.3555C10.3008 10.6371 9.71842 10.0547 9 10.0547Z" fill="#686868"/>
									</svg>
								</span>
								Your Transaction is Secured With SSL Encryption
							</a>
						</form>
					</div>
					<div class="col-xl-4 side-bar">
						<h2 class="title m-b15">Order Summery</h2>
						<div class="order-detail sticky-top">
							<div class="cart-item style-1">
								<div class="dz-media">
									<img src="{{ asset('assets/images/shop/shop-cart/pic1.jpg') }}" alt="/">
								</div>
								<div class="dz-content">
									<h6 class="title mb-0">Indoor Oasis</h6>
									<span class="price">$60.00</span>
								</div>
							</div>
							<div class="cart-item style-1">
								<div class="dz-media">
									<img src="{{ asset('assets/images/shop/shop-cart/pic2.jpg') }}" alt="/">
								</div>
								<div class="dz-content">
									<h6 class="title mb-0">TallStalk Gardens</h6>
									<span class="price">$40.00</span>
								</div>
							</div>
							<div class="form-group m-b20  m-t20 style-2">
								<div class="input-group mb-0">
									<input name="number" required="required" type="number" class="form-control" placeholder="Discount Code">
									<div class="input-group-addon">
										<button name="submit" value="Submit" type="submit" class="btn coupon btn-outline-secondary btn-md m-l10 h-100">
											Apply
										</button>
									</div>
								</div>
							</div>
							<table>
								<tbody>
									<tr class="subtotal">
										<td>Subtotal</td>
										<td class="price">$100.0</td>
									</tr>
									<tr class="subtotal">
										<td>Shipping Cost</td>
										<td class="price">+$0.99</td>
									</tr>
									<tr class="subtotal">
										<td>Discount (20%)</td>
										<td class="price text-primary">-$20.00</td>
									</tr>
									<tr class="total">
										<td>Total</td>
										<td class="price">$125.75</td>
									</tr>
								</tbody>
							</table>
							<p class="text">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a class="font-weight-500"  href="javascript:void(0);">privacy policy.</a></p>
							<div class="form-group">
								<div class="custom-control custom-checkbox d-flex m-b15">
									<input type="checkbox" class="form-check-input" id="basic_checkbox_03">
									<label class="form-check-label" for="basic_checkbox_03">I have read and agree to the website terms and conditions </label>
								</div>
							</div>
							<a href="shop-checkout.html" class="btn btn-secondary w-100 m-b10 text-uppercase">Place Order</a>
							<a href="shop-cart.html" class="btn btn-outline-secondary w-100 text-uppercase">back to cart</a>
						</div>
					</div>
				</div>
			</div>
		</div>

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