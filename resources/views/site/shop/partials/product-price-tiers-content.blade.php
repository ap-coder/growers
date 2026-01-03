{{-- Product Price Tiers Content (for accordion) --}}
{{-- min_quantity = units per pack, max_quantity = total units limit at this tier (null = unlimited) --}}
{{-- Example: min=10, max=20 means 10 units/pack, can buy up to 20 units (2 packs) at this price --}}
@php
    $priceTiers = $product->priceTiers;
    $tiersByGroup = $priceTiers->groupBy('tier_group');
@endphp

@foreach($tiersByGroup as $groupName => $groupTiers)
    <div class="variation-group" style="{{ !$loop->first ? 'margin-top: 0.5rem;' : '' }}">
        <div class="bg-secondary text-white py-1" style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding-left: 1.25rem; margin-bottom: 0.5rem;">{{ $groupName ?: 'Pack Sizes' }}</div>
        <div class="variation-options">
            @foreach($groupTiers as $tier)
                @php
                    $packSize = $tier->min_quantity;
                    $maxUnits = $tier->max_quantity;
                    $maxPacks = $maxUnits ? floor($maxUnits / $packSize) : null;
                    $packPrice = $tier->price * $packSize;
                @endphp
                <div class="variation-item d-flex align-items-center justify-content-between" style="font-size: 0.8rem; padding: 0.1rem 0.5rem 0.1rem 1.5rem; border-bottom: 1px solid #eee;">
                    <div class="variation-info flex-grow-1">
                        @if($tier->label)
                            <span style="font-weight: 600; color: #000;">{{ $tier->label }}</span>
                            <span class="ms-1" style="font-size: 0.75rem; color: #555;">({{ $packSize }} units/pack)</span>
                        @else
                            <span style="font-weight: 600; color: #000;">{{ $packSize }} units/pack</span>
                        @endif
                        @if($maxPacks)
                            <span class="ms-1" style="font-size: 0.7rem; color: #888;">max {{ $maxPacks }}</span>
                        @endif
                        @if($tier->discount_percent)
                            <span class="text-success ms-1" style="font-size: 0.75rem;">{{ $tier->discount_percent }}% off</span>
                        @endif
                    </div>
                    <div class="variation-price text-end d-flex align-items-center" style="min-width: 180px;">
                        <span style="font-size: 0.75rem; color: #666;">${{ number_format($tier->price, 2) }}/ea</span>
                        <span class="ms-2" style="font-weight: 600; color: var(--primary); font-size: 0.875rem;">${{ number_format($packPrice, 2) }}</span>
                        <input type="number" 
                               class="form-control form-control-sm tier-qty-input ms-2" 
                               value="0" 
                               min="0" 
                               {{ $maxPacks ? 'max=' . $maxPacks : '' }}
                               style="width: 50px; text-align: center; padding: 0.15rem 0.25rem; font-size: 0.8rem;"
                               data-tier-id="{{ $tier->id }}"
                               data-unit-price="{{ $tier->price }}"
                               data-pack-size="{{ $packSize }}"
                               data-pack-price="{{ $packPrice }}"
                               data-max-packs="{{ $maxPacks }}"
                               data-max-units="{{ $maxUnits }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
<small class="text-muted" style="font-size: 0.75rem;">Enter number of packs to order.</small>
