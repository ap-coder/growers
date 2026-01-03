{{-- Product Variations Content (for accordion) --}}
@php
    $clientId = $clientId ?? null;
    $variations = $product->variations()->where('published', true)->where('active', true)->orderBy('variation_category_id')->orderBy('sort_order')->get();
    $variationsByCategory = $variations->groupBy('variation_category_id');
@endphp

@foreach($variationsByCategory as $categoryId => $categoryVariations)
    @php
        $categoryModel = \App\Models\VariationCategory::find($categoryId);
        $categoryName = $categoryModel->name ?? 'Options';
    @endphp
    <div class="variation-group m-b15">
        <label class="form-label fw-bold">{{ $categoryName }}</label>
        <div class="variation-options">
            @foreach($categoryVariations as $variation)
                @php
                    $varPrice = $variation->getPriceForClient($clientId) ?? $variation->base_price;
                    $isOutOfStock = $variation->quantity !== null && $variation->quantity <= 0;
                @endphp
                <div class="variation-item d-flex align-items-center justify-content-between p-2 mb-2 rounded {{ $isOutOfStock ? 'bg-light text-muted' : 'border' }}">
                    <div class="variation-info flex-grow-1">
                        <span class="variation-name fw-medium">{{ $variation->name }}</span>
                        @if($variation->sku)
                            <small class="text-muted ms-2">{{ $variation->sku }}</small>
                        @endif
                        @if($variation->show_quantity && $variation->quantity !== null)
                            <span class="stock-badge ms-2">
                                @if($variation->quantity > 10)
                                    <span class="badge badge-sm bg-success">{{ $variation->quantity }} avail</span>
                                @elseif($variation->quantity > 0)
                                    <span class="badge badge-sm bg-warning text-dark">{{ $variation->quantity }} left</span>
                                @else
                                    <span class="badge badge-sm bg-danger">Out of Stock</span>
                                @endif
                            </span>
                        @endif
                    </div>
                    <div class="variation-price text-end me-3" style="min-width: 70px;">
                        @if($varPrice)
                            <span class="price">${{ number_format($varPrice, 2) }}</span>
                        @endif
                    </div>
                    <div class="variation-qty">
                        <input type="number" 
                               class="form-control form-control-sm variation-qty-input" 
                               id="variation-qty-{{ $variation->id }}"
                               data-variation-id="{{ $variation->id }}"
                               data-product-id="{{ $product->id }}"
                               data-price="{{ $varPrice }}"
                               value="0"
                               min="0"
                               {{ $variation->quantity !== null ? 'max=' . $variation->quantity : '' }}
                               style="width: 70px; text-align: center; -moz-appearance: textfield; -webkit-appearance: none;"
                               {{ $isOutOfStock ? 'disabled' : '' }}>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
