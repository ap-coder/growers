{{-- Product Accessories Content (for accordion) --}}
@php
    $clientId = $clientId ?? null;
    $accessoriesByType = $product->getAccessoriesByType();
@endphp

@foreach($accessoriesByType as $typeName => $typeAccessories)
    <div class="variation-group">
        <div class="bg-secondary text-white py-1" style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding-left: 1.75rem;">{{ $typeName }}</div>
        <div class="variation-options">
            @foreach($typeAccessories as $accessory)
                @php
                    $includedInPrice = $accessory->pivot->included_in_price ?? false;
                    $isDefault = $accessory->pivot->is_default ?? false;
                    $accPrice = $accessory->getPriceForClient($clientId);
                @endphp
                <div class="variation-item d-flex align-items-center justify-content-between {{ $includedInPrice ? 'bg-light' : '' }}" style="font-size: 0.8rem; padding: 0.1rem 0 0.1rem 2.25rem; border-bottom: 1px solid #eee;{{ $loop->first ? ' margin-top: 0.5rem;' : '' }}">
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
                    <div class="variation-qty" style="margin-right: 15px;">
                        <input type="number" 
                               class="form-control form-control-sm accessory-qty-input" 
                               data-accessory-id="{{ $accessory->id }}"
                               data-price="{{ $includedInPrice ? 0 : $accPrice }}"
                               data-included="{{ $includedInPrice ? '1' : '0' }}"
                               value="{{ $isDefault ? 1 : 0 }}"
                               min="0"
                               style="width: 40px; text-align: center; font-size: 0.75rem; padding: 0.1rem; height: 1.5rem; border-radius: 0;">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
