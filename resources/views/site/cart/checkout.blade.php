@extends('site.layouts.app')

@section('title', 'Checkout - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.cart.index') }}">Cart</a></li>
                    <li class="breadcrumb-item">Checkout</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<section class="content-inner shop-account">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                {{-- Coupon Section - Commented Out
                <div class="accordion dz-accordion accordion-sm" id="accordionFaq">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Have a coupon? <span class="text-primary m-l5"> Click here to enter your code </span>
                                <span class="toggle-close"></span>
                            </a>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFaq">
                            <div class="accordion-body">
                                <div class="form-group m-b20 style-2">
                                    <div class="input-group mb-0">
                                        <input name="coupon_code" type="text" class="form-control" placeholder="Discount Code">
                                        <div class="input-group-addon">
                                            <button type="button" class="btn btn-outline-secondary btn-md">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                --}}
                
                <form action="#" method="POST" class="row" id="checkout-form">
                    @csrf
                    
                    <div class="col-12">
                        <h4 class="title mb-3">Billing Details</h4>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group m-b15">
                            <label class="label-title">First Name *</label>
                            <input name="first_name" required class="form-control" placeholder="First Name" value="{{ old('first_name', auth()->user()->first_name ?? '') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group m-b15">
                            <label class="label-title">Last Name *</label>
                            <input name="last_name" required class="form-control" placeholder="Last Name" value="{{ old('last_name', auth()->user()->last_name ?? '') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group m-b15">
                            <label class="label-title">Email *</label>
                            <input name="email" type="email" required class="form-control" placeholder="Email Address" value="{{ old('email', auth()->user()->email ?? '') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group m-b15">
                            <label class="label-title">Phone Number *</label>
                            <input name="phone" type="tel" required class="form-control" placeholder="Phone Number" value="{{ old('phone', auth()->user()->phone ?? '') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group m-b15">
                            <label class="label-title">Company name (optional)</label>
                            <input name="company" class="form-control" placeholder="Company Name" value="{{ old('company') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group m-b15">
                            <label class="label-title">Street address *</label>
                            <input name="address_line1" required class="form-control m-b15" placeholder="House number and street name" value="{{ old('address_line1') }}">
                            <input name="address_line2" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)" value="{{ old('address_line2') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group m-b15">
                            <label class="label-title">City *</label>
                            <input name="city" required class="form-control" placeholder="City" value="{{ old('city') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group m-b15">
                            <label class="label-title">State *</label>
                            <input name="state" required class="form-control" placeholder="State" value="{{ old('state') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group m-b15">
                            <label class="label-title">Zip Code *</label>
                            <input name="zip_code" required class="form-control" placeholder="Zip Code" value="{{ old('zip_code') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group m-b15">
                            <label class="label-title">Country *</label>
                            <input name="country" required class="form-control" placeholder="Country" value="{{ old('country', 'United States') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-12 m-b40">
                        <div class="form-group">
                            <label class="label-title">Order notes (optional)</label>
                            <textarea name="notes" placeholder="Notes about your order, e.g. special notes for delivery." class="form-control" rows="5">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    
                    {{-- Shipping Methods - Removed as requested
                    <div class="col-md-12">
                        <h4 class="title m-b15 text-capitalize">Shipping Methods</h4>
                    </div>
                    --}}
                    
                    {{-- Payment Methods - Removed as requested
                    <div class="col-md-12">
                        <h2 class="title m-b15 text-capitalize">Payment Methods</h2>
                    </div>
                    --}}
                    
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary btn-lg w-100">
                            <i class="fas fa-check-circle mr-2"></i> Place Order
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="col-xl-4 side-bar">
                <h2 class="title m-b15">Order Summary</h2>
                <div class="order-detail sticky-top">
                    @php
                        $cartTotal = 0;
                    @endphp
                    
                    @foreach($cart as $productId => $items)
                        @php
                            $product = $items->first()->product;
                            $productTotal = 0;
                        @endphp
                        <div class="mb-3 pb-3 border-bottom">
                            <h6 class="mb-2"><strong>{{ $product->name ?? 'Product' }}</strong></h6>
                            @foreach($items as $item)
                                @php
                                    $lineTotal = $item->quantity * $item->price;
                                    $productTotal += $lineTotal;
                                    $cartTotal += $lineTotal;
                                @endphp
                                <div class="d-flex justify-content-between small mb-1">
                                    <span>{{ $item->quantity }} | {{ $item->variation->name ?? $item->variation_name }}</span>
                                    <span>${{ number_format($item->price, 2) }} x {{ $item->quantity }}</span>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-between mt-2 pt-2 border-top">
                                <strong class="small">Product Total:</strong>
                                <strong class="text-primary">${{ number_format($productTotal, 2) }}</strong>
                            </div>
                        </div>
                    @endforeach
                    
                    {{-- Discount Code - Commented Out
                    <div class="form-group m-b20 m-t20 style-2">
                        <div class="input-group mb-0">
                            <input name="discount_code" type="text" class="form-control" placeholder="Discount Code">
                            <div class="input-group-addon">
                                <button type="button" class="btn coupon btn-outline-secondary btn-md m-l10 h-100">
                                    Apply
                                </button>
                            </div>
                        </div>
                    </div>
                    --}}
                    
                    <table>
                        <tbody>
                            <tr class="subtotal">
                                <td>Subtotal</td>
                                <td class="price">${{ number_format($cartTotal, 2) }}</td>
                            </tr>
                            <tr class="title">
                                <td>
                                    <h6 class="mb-0">Total</h6>
                                </td>
                                <td class="price text-secondary">
                                    <h5 class="mb-0">${{ number_format($cartTotal, 2) }}</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
