{{-- Product Price Tiers Content (for accordion) --}}
@php
    $priceTiers = $product->priceTiers;
    $tiersByGroup = $priceTiers->groupBy('tier_group');
@endphp

@foreach($tiersByGroup as $groupName => $groupTiers)
    <div class="variation-group" style="{{ !$loop->first ? 'margin-top: 0.5rem;' : '' }}">
        <div class="bg-secondary text-white py-1" style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; padding-left: 1.25rem; margin-bottom: 0.5rem;">{{ $groupName ?: 'Volume Pricing' }}</div>
        <div class="variation-options">
            @foreach($groupTiers as $tier)
                <div class="variation-item d-flex align-items-center justify-content-between" style="font-size: 0.8rem; padding: 0.1rem 0.5rem 0.1rem 1.5rem; border-bottom: 1px solid #eee;">
                    <div class="variation-info flex-grow-1">
                        @if($tier->label)
                            <span style="font-weight: 600; color: #000;">{{ $tier->label }}</span>
                            <span class="ms-1" style="font-size: 0.75rem; color: #555;">({{ $tier->quantity_range }} units)</span>
                        @else
                            <span style="font-weight: 600; color: #000;">{{ $tier->quantity_range }} units</span>
                        @endif
                        @if($tier->discount_percent)
                            <span class="text-success ms-1" style="font-size: 0.75rem;">{{ $tier->discount_percent }}% off</span>
                        @endif
                    </div>
                    <div class="variation-price text-end" style="min-width: 80px;">
                        <span style="font-weight: 600; color: var(--primary); font-size: 0.875rem;">${{ number_format($tier->price, 2) }}/ea</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
<small class="text-muted" style="font-size: 0.75rem;">Prices apply based on quantity ordered.</small>
