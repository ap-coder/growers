{{-- Product Order Section - Variations with quantities and single Add to Cart --}}
@php
    $clientId = $clientId ?? null;
    $variations = $product->variations()->where('published', true)->where('active', true)->orderBy('variation_category_id')->orderBy('sort_order')->get();
    $hasVariations = $variations->count() > 0;
    $variationsByCategory = $variations->groupBy('variation_category_id');
@endphp

<div class="product-order-section">
    <hr class="my-4">
    
    @if($hasVariations)
        {{-- Variations List Grouped by Category --}}
        <div class="variations-list mb-4">
            <h5 class="mb-3">Select Options</h5>
            
            @foreach($variationsByCategory as $category => $categoryVariations)
            <div class="variation-category mb-3">
                @php
                    $categoryModel = \App\Models\VariationCategory::find($category);
                @endphp
                <h6 class="text-muted mb-2">
                    <i class="fas fa-tag me-1"></i>
                    {{ $categoryModel->name ?? 'Options' }}
                </h6>
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        @if($loop->first)
                        <thead class="table-light">
                            <tr>
                                <th>Option</th>
                                <th class="text-end" style="width: 120px;">Price</th>
                                <th class="text-center" style="width: 140px;">Quantity</th>
                            </tr>
                        </thead>
                        @endif
                        <tbody>
                            @foreach($categoryVariations as $variation)
                                @php
                                    $varPrice = $variation->getPriceForClient($clientId) ?? $variation->base_price;
                                @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $variation->name }}</strong>
                                        @if($variation->description)
                                            <br><small class="text-muted">{{ $variation->description }}</small>
                                        @endif
                                        @if($variation->sku)
                                            <br><small class="text-muted">SKU: {{ $variation->sku }}</small>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if($varPrice)
                                            ${{ number_format($varPrice, 2) }}
                                        @else
                                            <span class="text-muted">--</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <button class="btn btn-outline-secondary" type="button" onclick="decrementVariationQty({{ $variation->id }})">-</button>
                                            <input type="number" class="form-control text-center variation-qty" 
                                                   id="variation-qty-{{ $variation->id }}" 
                                                   data-variation-id="{{ $variation->id }}"
                                                   data-product-id="{{ $product->id }}"
                                                   data-price="{{ $varPrice }}"
                                                   value="0" min="0">
                                            <button class="btn btn-outline-secondary" type="button" onclick="incrementVariationQty({{ $variation->id }})">+</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    @else
        {{-- No variations - show base product quantity --}}
        <div class="base-product-qty mb-4">
            <div class="row align-items-center">
                <div class="col-auto">
                    <strong>{{ $product->name }}</strong>
                    @if($product->sku)
                        <br><small class="text-muted">SKU: {{ $product->sku }}</small>
                    @endif
                </div>
                <div class="col-auto ms-auto text-end">
                    @php $basePrice = $product->getPriceForClient($clientId); @endphp
                    @if($basePrice)
                        <strong>${{ number_format($basePrice, 2) }}</strong>
                    @endif
                </div>
                <div class="col-auto" style="width: 140px;">
                    <div class="input-group input-group-sm">
                        <button class="btn btn-outline-secondary" type="button" onclick="decrementBaseQty()">-</button>
                        <input type="number" class="form-control text-center" id="base-product-qty" 
                               data-product-id="{{ $product->id }}"
                               data-price="{{ $basePrice }}"
                               value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" onclick="incrementBaseQty()">+</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <hr class="my-4">
    
    {{-- Single Add to Cart Button --}}
    <div class="add-to-cart-section">
        <button class="btn btn-primary btn-lg w-100" onclick="addAllToCart({{ $product->id }})">
            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
        </button>
    </div>
</div>

@push('scripts')
<script>
function incrementVariationQty(variationId) {
    var input = document.getElementById('variation-qty-' + variationId);
    input.value = parseInt(input.value) + 1;
}

function decrementVariationQty(variationId) {
    var input = document.getElementById('variation-qty-' + variationId);
    if (parseInt(input.value) > 0) {
        input.value = parseInt(input.value) - 1;
    }
}

function incrementBaseQty() {
    var input = document.getElementById('base-product-qty');
    input.value = parseInt(input.value) + 1;
}

function decrementBaseQty() {
    var input = document.getElementById('base-product-qty');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

function addAllToCart(productId) {
    var items = [];
    
    // Check for variations
    var variationInputs = document.querySelectorAll('.variation-qty');
    if (variationInputs.length > 0) {
        variationInputs.forEach(function(input) {
            var qty = parseInt(input.value);
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
            alert('Please select at least one option with a quantity greater than 0.');
            return;
        }
    } else {
        // Base product only
        var baseInput = document.getElementById('base-product-qty');
        var qty = parseInt(baseInput.value);
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
    alert('Adding ' + items.length + ' item(s) to cart. (Cart functionality to be implemented)');
}
</script>
@endpush
