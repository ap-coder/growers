@extends('site.layouts.app')

@section('title', 'Shopping Cart - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Cart</li>
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
            <div class="col-lg-8">
                @if($cart && $cart->count() > 0)
                    @php
                        $cartTotal = 0;
                    @endphp
                    
                    @foreach($cart as $productId => $items)
                        @php
                            $firstItem = $items->first();
                            $product = \App\Models\Product::find($productId);
                            $productTotal = 0;
                            $placeholder = 'https://placehold.co/80x80/EEE/31343C/webp?font=oswald&text=' . urlencode($product->name ?? 'Product');
                        @endphp
                        
                        <div class="cart-product-group mb-4">
                            <div class="d-flex align-items-start mb-3">
                                @if($product && !$product->is_fake && $product->photo)
                                    <img src="{{ $product->photo->url }}" alt="{{ $product->name }}" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px; border: 1px solid #ddd;">
                                @else
                                    <img src="{{ $placeholder }}" alt="{{ $product->name ?? 'Product' }}" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px; border: 1px solid #ddd;">
                                @endif
                                <div>
                                    <h5 class="mb-1">{{ $product->name ?? 'Product' }}</h5>
                                    @if($product && $product->sku)
                                        <small>Product SKU: {{ $product->sku }}</small>
                                    @endif
                                </div>
                                <a href="{{ route('site.cart.remove.product', $productId) }}" class="ms-auto text-danger" title="Remove Product">
                                    <i class="ti-close"></i>
                                </a>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 10%;">Qty</th>
                                            <th style="width: 50%;">Details</th>
                                            <th style="width: 20%;" class="text-end">Price</th>
                                            <th style="width: 20%;" class="text-end">Line Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                            @php
                                                $lineTotal = $item->quantity * $item->price;
                                                $productTotal += $lineTotal;
                                                $qty = $item->quantity ?? 1;
                                            @endphp
                                            <tr class="small">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <input type="number" 
                                                               class="form-control form-control-sm cart-qty-update" 
                                                               value="{{ intval($qty) }}" 
                                                               min="1"
                                                               data-cart-id="{{ $item->id }}"
                                                               autocomplete="off"
                                                               style="width: 60px; text-align: center;">
                                                        <span class="ms-2 text-muted small">({{ $qty }})</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->variation->name ?? $item->variation_name }}</strong>
                                                    @if($item->sku)
                                                        <small class="d-block">SKU: {{ $item->sku }}</small>
                                                    @endif
                                                </td>
                                                <td class="text-end">${{ number_format($item->price, 2) }}</td>
                                                <td class="text-end"><strong>${{ number_format($lineTotal, 2) }}</strong></td>
                                            </tr>
                                        @endforeach
                                        <tr class="border-top">
                                            <td colspan="3" class="text-end"><strong>Product Total:</strong></td>
                                            <td class="text-end"><strong class="text-primary">${{ number_format($productTotal, 2) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        @php
                            $cartTotal += $productTotal;
                        @endphp
                    @endforeach
                    
                    <div class="row shop-form mt-4 align-items-center">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="label-title">Order Special Instructions</label>
                                <textarea id="special_instructions" placeholder="Write your instructions..." class="form-control" name="special_instructions" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <a href="{{ route('site.shop.index') }}" class="btn btn-outline-secondary me-2">Continue Shopping</a>
                            <a href="{{ route('site.cart.clear') }}" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to empty your cart?')">Empty Cart</a>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="iconly-Broken-Buy" style="font-size: 4rem; color: #ccc;"></i>
                        <h4 class="mt-3">Your cart is empty</h4>
                        <p class="text-muted">Add some products to get started</p>
                        <a href="{{ route('site.shop.index') }}" class="btn btn-secondary mt-3">Browse Products</a>
                    </div>
                @endif
            </div>
            
            <div class="col-lg-4">
                @if($cart && $cart->count() > 0)
                    <div class="cart-detail sticky-top">
                        <h5 class="mb-3">Order Summary</h5>
                        
                        <div class="icon-bx-wraper style-4 m-b15">
                            <div class="icon-bx">
                                <i class="flaticon flaticon-ship"></i>
                            </div>
                            <div class="icon-content">
                                <span class="font-13">Free</span>
                                <h6 class="dz-title">Shipping</h6>
                            </div>
                        </div>
                        
                        <table class="w-100 mb-3">
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="py-2">Subtotal:</td>
                                    <td class="py-2 text-end">${{ number_format($cartTotal, 2) }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-2">Shipping:</td>
                                    <td class="py-2 text-end">Free</td>
                                </tr>
                                <tr class="total">
                                    <td class="py-3">
                                        <h5 class="mb-0">Cart Total:</h5>
                                    </td>
                                    <td class="py-3 text-end">
                                        <h5 class="mb-0 text-primary">${{ number_format($cartTotal, 2) }}</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <a href="{{ route('site.checkout') }}" target="_blank" class="btn btn-secondary w-100 btn-lg">PROCEED TO CHECKOUT</a>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted">Secure Checkout</small>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Ensure quantity values are set on page load
    $('.cart-qty-update').each(function() {
        const qty = $(this).data('quantity');
        if (qty && !$(this).val()) {
            $(this).val(qty);
        }
    });
    
    // Update cart quantity
    $('.cart-qty-update').on('change', function() {
        const qty = $(this).val();
        const cartId = $(this).data('cart-id');
        
        if (qty == 0) {
            if (confirm('Remove this item from cart?')) {
                updateCartQty(cartId, qty);
            } else {
                $(this).val(1);
            }
        } else {
            updateCartQty(cartId, qty);
        }
    });
    
    function updateCartQty(cartId, qty) {
        $.ajax({
            url: '{{ route("site.cart.update") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                cart_id: cartId,
                quantity: qty
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Error updating cart');
                }
            },
            error: function() {
                alert('Error updating cart');
            }
        });
    }
});
</script>
@endpush
