{{-- Product Accessories Content (for accordion) --}}
@php
    $clientId = $clientId ?? null;
    $accessoriesByType = $product->getAccessoriesByType();
@endphp

@foreach($accessoriesByType as $typeName => $typeAccessories)
    <div class="variation-group m-b15">
        <label class="form-label fw-bold">{{ $typeName }}</label>
        <div class="variation-options">
            @foreach($typeAccessories as $accessory)
                @php
                    $includedInPrice = $accessory->pivot->included_in_price ?? false;
                    $isDefault = $accessory->pivot->is_default ?? false;
                    $accPrice = $accessory->getPriceForClient($clientId);
                @endphp
                <div class="variation-item d-flex align-items-center justify-content-between p-2 mb-2 rounded {{ $includedInPrice ? 'bg-light' : 'border' }}">
                    <div class="variation-info flex-grow-1">
                        <span class="variation-name fw-medium">{{ $accessory->name }}</span>
                        @if($includedInPrice)
                            <span class="badge badge-sm bg-success ms-2">Included</span>
                        @endif
                        @if($isDefault)
                            <span class="badge badge-sm bg-info ms-2">Default</span>
                        @endif
                    </div>
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
