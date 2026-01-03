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
    <div class="variation-group" style="{{ !$loop->first ? 'margin-top: 0.5rem;' : '' }}">
        <div class="bg-secondary text-white py-1" style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding-left: 1.75rem; margin-bottom: 0.5rem;">{{ $categoryName }}</div>
        <div class="variation-options">
            @foreach($categoryVariations as $variation)
                @php
                    $varPrice = $variation->getPriceForClient($clientId) ?? $variation->base_price;
                    $isOutOfStock = $variation->quantity !== null && $variation->quantity <= 0;
                @endphp
                <div class="variation-item d-flex align-items-center justify-content-between {{ $isOutOfStock ? 'bg-light text-muted' : '' }}" style="font-size: 0.8rem; padding: 0.1rem 0 0.1rem 2.25rem; border-bottom: 1px solid #eee;{{ $loop->first ? ' margin-top: 0.5rem;' : '' }}">
                    <div class="variation-info flex-grow-1">
                        <span class="variation-name" style="font-weight: 600; color: #000;">{{ $variation->name }}</span>
                        @if($variation->sku)
                            <small class="ms-1" style="font-size: 0.75rem; color: #555;">{{ $variation->sku }}</small>
                        @endif
                        @if($variation->show_quantity && $variation->quantity !== null)
                            <span class="stock-badge ms-1">
                                @if($variation->quantity > 10)
                                    <span class="badge bg-success" style="font-size: 0.65rem;">{{ $variation->quantity }}</span>
                                @elseif($variation->quantity > 0)
                                    <span class="badge bg-warning text-dark" style="font-size: 0.65rem;">{{ $variation->quantity }}</span>
                                @else
                                    <span class="badge bg-danger" style="font-size: 0.65rem;">Out</span>
                                @endif
                            </span>
                        @endif
                    </div>
                    <div class="variation-price text-end me-2" style="min-width: 55px;">
                        @if($varPrice)
                            <span style="font-weight: 600; color: var(--primary); font-size: 0.875rem;">${{ number_format($varPrice, 2) }}</span>
                        @endif
                    </div>
                    <div class="variation-qty" style="margin-right: 15px;">
                        <input type="number" 
                               class="form-control form-control-sm variation-qty-input" 
                               id="variation-qty-{{ $variation->id }}"
                               data-variation-id="{{ $variation->id }}"
                               data-product-id="{{ $product->id }}"
                               data-price="{{ $varPrice }}"
                               value="0"
                               min="0"
                               {{ $variation->quantity !== null ? 'max=' . $variation->quantity : '' }}
                               style="width: 40px; text-align: center; font-size: 0.75rem; padding: 0.1rem; height: 1.5rem; border-radius: 0;"
                               {{ $isOutOfStock ? 'disabled' : '' }}>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
