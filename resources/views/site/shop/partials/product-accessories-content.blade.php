{{-- Product Accessories Content (for accordion) --}}
@php
    $clientId = $clientId ?? null;
    $accessoriesByType = $product->getAccessoriesByType();
@endphp

@foreach($accessoriesByType as $typeName => $typeAccessories)
    <div class="variation-group">
        <div class="bg-secondary text-white py-1 px-2 rounded-top" style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">{{ $typeName }}</div>
        <div class="variation-options">
            @foreach($typeAccessories as $accessory)
                @php
                    $includedInPrice = $accessory->pivot->included_in_price ?? false;
                    $isDefault = $accessory->pivot->is_default ?? false;
                    $accPrice = $accessory->getPriceForClient($clientId);
                @endphp
                <div class="variation-item d-flex align-items-center justify-content-between {{ $includedInPrice ? 'bg-light' : '' }}" style="font-size: 0.875rem; padding: 0.15rem 0.25rem; border-bottom: 1px solid #eee;">
                    <div class="variation-info flex-grow-1">
                        <span class="variation-name" style="font-weight: 600; color: #000;">{{ $accessory->name }}</span>
                        @if($includedInPrice)
                            <span class="badge bg-success ms-1" style="font-size: 0.65rem;">Incl</span>
                        @endif
                        @if($isDefault)
                            <span class="badge bg-info ms-1" style="font-size: 0.65rem;">Def</span>
                        @endif
                    </div>
                    <div class="variation-price text-end me-2" style="min-width: 55px;">
                        @if(!$includedInPrice && $accPrice)
                            <span style="font-weight: 600; color: var(--primary); font-size: 0.875rem;">${{ number_format($accPrice, 2) }}</span>
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
                               style="width: 50px; text-align: center; font-size: 0.875rem; padding: 0.2rem;">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
