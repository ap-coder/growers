{{-- Product Order Section - Add to Cart and Base Price --}}
<style>
.variation-qty-input::-webkit-outer-spin-button,
.variation-qty-input::-webkit-inner-spin-button,
.accessory-qty-input::-webkit-outer-spin-button,
.accessory-qty-input::-webkit-inner-spin-button {
    -webkit-appearance: none !important;
    margin: 0 !important;
    display: none !important;
}
.variation-qty-input,
.accessory-qty-input {
    -moz-appearance: textfield !important;
}
</style>
@php
    $clientId = $clientId ?? null;
    $hasVariations = $product->variations()->where('published', true)->where('active', true)->count() > 0;
    $basePrice = $product->getPriceForClient($clientId);
@endphp

<div class="dz-product-detail style-4">
    <div class="dz-content">
        {{-- Base Product Price --}}
        <div class="meta-content m-b20 d-flex align-items-center justify-content-between">
            <div>
                <span class="form-label d-block">Price</span>
                <span class="price h4 mb-0">${{ number_format($basePrice ?? 0, 2) }}</span>
                @if($product->full_price && $product->full_price > $basePrice)
                    <span class="text-muted text-decoration-line-through ms-2">${{ number_format($product->full_price, 2) }}</span>
                @endif
            </div>
            @if(!$hasVariations)
                <div>
                    <label class="form-label">Quantity</label>
                    <input id="base-product-qty" type="number" value="1" min="1"
                           class="form-control form-control-sm"
                           style="width: 70px; text-align: center;"
                           data-product-id="{{ $product->id }}"
                           data-price="{{ $basePrice }}">
                </div>
            @endif
        </div>
        
        {{-- Add to Cart Button --}}
        <div class="btn-group cart-btn m-b20">
            <a href="javascript:void(0);" class="btn btn-secondary text-uppercase" onclick="addAllToCart({{ $product->id }})">
                <i class="flaticon flaticon-shopping-cart-1 me-2"></i> Add To Cart
            </a>
            <a href="javascript:void(0);" class="btn btn-outline-secondary btn-icon add-to-wishlist" data-product-id="{{ $product->id }}">
                <i class="flaticon flaticon-heart-3"></i>
            </a>
        </div>
    </div>
</div>


@push('scripts')
<script>
function updateRunningTotal() {
    var total = 0;
    
    // Check for variations
    var variationInputs = document.querySelectorAll('.variation-qty-input');
    if (variationInputs.length > 0) {
        variationInputs.forEach(function(input) {
            var qty = parseInt(input.value) || 0;
            var price = parseFloat(input.dataset.price) || 0;
            if (qty > 0) {
                total += qty * price;
            }
        });
    } else {
        // Base product only
        var baseInput = document.getElementById('base-product-qty');
        if (baseInput) {
            var qty = parseInt(baseInput.value) || 0;
            var price = parseFloat(baseInput.dataset.price) || 0;
            total = qty * price;
        }
    }
    
    // Add accessory prices
    var accessoryInputs = document.querySelectorAll('.accessory-qty-input');
    accessoryInputs.forEach(function(input) {
        var qty = parseInt(input.value) || 0;
        var price = parseFloat(input.dataset.price) || 0;
        if (qty > 0) {
            total += qty * price;
        }
    });
    
    document.getElementById('running-total').textContent = '$' + total.toFixed(2);
}

function addAllToCart(productId) {
    var items = [];
    
    // Check for variations
    var variationInputs = document.querySelectorAll('.variation-qty-input');
    if (variationInputs.length > 0) {
        variationInputs.forEach(function(input) {
            var qty = parseInt(input.value) || 0;
            if (qty > 0) {
                items.push({
                    product_id: productId,
                    variation_id: input.dataset.variationId,
                    quantity: qty,
                    price: parseFloat(input.dataset.price) || 0
                });
            }
        });
        
        if (items.length === 0) {
            Swal.fire({
                title: 'No Items Selected',
                text: 'Please select at least one option with a quantity greater than 0.',
                icon: 'warning'
            });
            return;
        }
    } else {
        // Base product only
        var baseInput = document.getElementById('base-product-qty');
        var qty = parseInt(baseInput.value) || 1;
        if (qty > 0) {
            items.push({
                product_id: productId,
                variation_id: null,
                quantity: qty,
                price: parseFloat(baseInput.dataset.price) || 0
            });
        }
    }
    
    // TODO: Implement actual cart functionality
    console.log('Adding to cart:', items);
    Swal.fire({
        title: 'Added to Cart!',
        text: items.length + ' item(s) added to cart.',
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    });
}

// Update total on quantity change
document.addEventListener('DOMContentLoaded', function() {
    // Variation inputs
    document.querySelectorAll('.variation-qty-input').forEach(function(input) {
        input.addEventListener('input', updateRunningTotal);
        input.addEventListener('change', updateRunningTotal);
    });
    
    // Accessory inputs
    document.querySelectorAll('.accessory-qty-input').forEach(function(input) {
        input.addEventListener('input', updateRunningTotal);
        input.addEventListener('change', updateRunningTotal);
    });
    
    // Base product input
    var baseInput = document.getElementById('base-product-qty');
    if (baseInput) {
        baseInput.addEventListener('input', updateRunningTotal);
        baseInput.addEventListener('change', updateRunningTotal);
    }
    
    // Initial calculation
    updateRunningTotal();
});
</script>
@endpush
