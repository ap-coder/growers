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

@if(!$hasVariations)
    {{-- No variations - show quantity input --}}
    <div class="meta-content m-b20 d-flex align-items-center">
        <div>
            <label class="form-label">Quantity</label>
            <input id="base-product-qty" type="number" value="1" min="1"
                   class="form-control form-control-sm"
                   style="width: 70px; text-align: center;"
                   data-product-id="{{ $product->id }}"
                   data-price="{{ $basePrice }}">
        </div>
    </div>
@endif

{{-- Add to Cart Button --}}
<div class="btn-group cart-btn m-b20">
    <a href="javascript:void(0);" class="btn btn-secondary text-uppercase" onclick="addAllToCart({{ $product->id }})">
        <i class="flaticon flaticon-shopping-cart-1 me-2"></i> Add To Cart
    </a>
    <a href="javascript:void(0);" class="btn btn-outline-secondary btn-icon add-to-wishlist {{ ($inWishlist ?? false) ? 'active' : '' }}" data-product-id="{{ $product->id }}">
        <i class="flaticon {{ ($inWishlist ?? false) ? 'flaticon-heart-1' : 'flaticon-heart-3' }}"></i>
    </a>
</div>


@push('scripts')
<script>
// Wishlist toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-wishlist').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var productId = this.dataset.productId;
            var icon = this.querySelector('i');
            
            fetch('{{ route("site.wishlist.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Toggle heart icon state
                    if (data.in_wishlist) {
                        icon.classList.remove('flaticon-heart-3');
                        icon.classList.add('flaticon-heart-1');
                        this.classList.add('active');
                    } else {
                        icon.classList.remove('flaticon-heart-1');
                        icon.classList.add('flaticon-heart-3');
                        this.classList.remove('active');
                    }
                    
                    // Show success message
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: data.in_wishlist ? 'Favorited for later!' : 'Removed from favorites',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                } else if (data.redirect) {
                    // Not logged in - redirect to login
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: data.message,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Login',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = data.redirect;
                            }
                        });
                    } else {
                        alert(data.message);
                        window.location.href = data.redirect;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error'
                    });
                }
            });
        });
    });
});

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
    
    // Add tier/bulk pricing quantities (qty = number of packs, multiply by pack price)
    var tierInputs = document.querySelectorAll('.tier-qty-input');
    tierInputs.forEach(function(input) {
        var qty = parseInt(input.value) || 0;
        var packPrice = parseFloat(input.dataset.packPrice) || 0;
        if (qty > 0) {
            total += qty * packPrice;
        }
    });
    
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
    } else {
        // Base product only
        var baseInput = document.getElementById('base-product-qty');
        if (baseInput) {
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
    }
    
    // Add tier/bulk pricing items (qty = number of packs)
    var tierInputs = document.querySelectorAll('.tier-qty-input');
    tierInputs.forEach(function(input) {
        var numPacks = parseInt(input.value) || 0;
        if (numPacks > 0) {
            var packSize = parseInt(input.dataset.packSize) || 1;
            var totalUnits = numPacks * packSize;
            items.push({
                product_id: productId,
                tier_id: input.dataset.tierId,
                quantity: totalUnits,
                num_packs: numPacks,
                pack_size: packSize,
                unit_price: parseFloat(input.dataset.unitPrice) || 0,
                pack_price: parseFloat(input.dataset.packPrice) || 0
            });
        }
    });
    
    if (items.length === 0) {
        Swal.fire({
            title: 'No Items Selected',
            text: 'Please enter a quantity for at least one item.',
            icon: 'warning'
        });
        return;
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
    
    // Tier/bulk pricing inputs
    document.querySelectorAll('.tier-qty-input').forEach(function(input) {
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
