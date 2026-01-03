{{-- Product Price Tiers Content (for accordion) --}}
{{-- min_quantity = units per pack, max_quantity = total units limit at this tier (null = unlimited) --}}
{{-- Example: min=10, max=20 means 10 units/pack, can buy up to 20 units (2 packs) at this price --}}
@php
    $priceTiers = $product->priceTiers;
    $tiersByGroup = $priceTiers->groupBy('tier_group');
@endphp

@foreach($tiersByGroup as $groupName => $groupTiers)
    <div class="variation-group" style="{{ !$loop->first ? 'margin-top: 0.5rem;' : '' }}">
        <div class="bg-secondary text-white py-1" style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding-left: 1.75rem; margin-bottom: 0.5rem;">{{ $groupName ?: 'Pack Sizes' }}</div>
        <div class="variation-options">
            @foreach($groupTiers as $tier)
                @php
                    $packSize = $tier->min_quantity;
                    $maxUnits = $tier->max_quantity;
                    $maxPacks = $maxUnits ? floor($maxUnits / $packSize) : null;
                    $packPrice = $tier->price * $packSize;
                @endphp
                <div class="variation-item d-flex align-items-center justify-content-between" style="font-size: 0.8rem; padding: 0.1rem 0 0.1rem 2.25rem; border-bottom: 1px solid #eee;{{ $loop->first ? ' margin-top: 0.5rem;' : '' }}">
                    <div class="variation-info flex-grow-1">
                        <span class="variation-name" style="font-weight: 600; color: #000;">
                            @if($tier->label)
                                {{ $tier->label }}
                            @else
                                {{ $packSize }} units/pack
                            @endif
                        </span>
                        @if($tier->label)
                            <small class="ms-1" style="font-size: 0.75rem; color: #555;">({{ $packSize }}/pack)</small>
                        @endif
                        @if($maxPacks)
                            <small class="ms-1" style="font-size: 0.75rem; color: #555;">max {{ $maxPacks }}</small>
                        @endif
                        @if($tier->discount_percent)
                            <span class="badge bg-success ms-1" style="font-size: 0.65rem;">{{ $tier->discount_percent }}% off</span>
                        @endif
                    </div>
                    <div class="variation-price text-end me-2" style="min-width: 55px;">
                        <span style="font-weight: 600; color: var(--primary); font-size: 0.875rem;">${{ number_format($packPrice, 2) }}</span>
                    </div>
                    <div class="variation-qty" style="margin-right: 15px;">
                        <input type="number" 
                               class="form-control form-control-sm tier-qty-input" 
                               value="0" 
                               min="0" 
                               {{ $maxPacks ? 'max=' . $maxPacks : '' }}
                               style="width: 40px; text-align: center; font-size: 0.75rem; padding: 0.1rem; height: 1.5rem; border-radius: 0;"
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
