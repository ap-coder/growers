{{-- Product Accessories Section --}}
@php
    $accessoriesByType = $product->getAccessoriesByType();
@endphp

@if($accessoriesByType->count() > 0)
    @foreach($accessoriesByType as $typeId => $accessories)
        @php
            $accessoryType = $accessories->first()->accessoryType;
        @endphp
        <div class="variation-group m-b20">
            <label class="form-label">{{ $accessoryType->name ?? 'Accessories' }}</label>
            <div class="variation-options">
                @foreach($accessories as $accessory)
                    @php
                        $accPrice = $accessory->getPriceForClient($clientId);
                        $hasVariants = $accessory->hasVariants();
                        $variants = $hasVariants ? $accessory->publishedVariants : collect();
                        $isRequired = $accessory->pivot->is_required ?? false;
                        $isDefault = $accessory->pivot->is_default ?? false;
                        $includedInPrice = $accessory->pivot->included_in_price ?? false;
                    @endphp
                    <div class="variation-item d-flex align-items-center justify-content-between p-2 mb-2 rounded {{ $includedInPrice ? 'bg-light' : 'border' }}">
                        <div class="variation-info flex-grow-1">
                            <span class="variation-name fw-medium">{{ $accessory->name }}</span>
                            @if($accessory->sku)
                                <small class="text-muted ms-2">{{ $accessory->sku }}</small>
                            @endif
                            @if($includedInPrice)
                                <span class="badge badge-sm bg-success ms-2">Included</span>
                            @endif
                            @if($isRequired)
                                <span class="badge badge-sm bg-danger ms-2">Required</span>
                            @endif
                        </div>
                        
                        @if($hasVariants && $variants->count() > 0)
                            {{-- Accessory with variants - show dropdown --}}
                            <div class="me-3">
                                <select class="form-control form-control-sm accessory-variant-select" 
                                        data-accessory-id="{{ $accessory->id }}"
                                        style="min-width: 150px;">
                                    <option value="">-- Select --</option>
                                    @foreach($variants as $variant)
                                        @php
                                            $variantPrice = $variant->price ?? $accPrice;
                                        @endphp
                                        <option value="{{ $variant->id }}" 
                                                data-price="{{ $variantPrice }}"
                                                {{ $variant->is_default ? 'selected' : '' }}>
                                            {{ $variant->name }} - ${{ number_format($variantPrice, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        
                        <div class="variation-price text-end me-3" style="min-width: 70px;">
                            @if(!$includedInPrice && $accPrice)
                                <span class="price">${{ number_format($accPrice, 2) }}</span>
                            @endif
                        </div>
                        
                        <div class="variation-qty">
                            <input type="number" 
                                   class="form-control form-control-sm accessory-qty-input" 
                                   data-accessory-id="{{ $accessory->id }}"
                                   data-price="{{ $includedInPrice ? 0 : $accPrice }}"
                                   data-included="{{ $includedInPrice ? '1' : '0' }}"
                                   value="{{ $isDefault ? 1 : 0 }}"
                                   min="0"
                                   style="width: 70px; text-align: center; -moz-appearance: textfield; -webkit-appearance: none;">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endif
