{{-- Product Price Tiers Section --}}
@php
    $priceTiers = $product->priceTiers;
    $tiersByGroup = $priceTiers->groupBy('tier_group');
@endphp

@if($priceTiers->count() > 0)
    @foreach($tiersByGroup as $groupName => $groupTiers)
        <div class="variation-group m-b20">
            <label class="form-label">{{ $groupName ?: 'Bulk Pricing' }}</label>
            <div class="variation-options">
                @foreach($groupTiers as $tier)
                    <div class="variation-item d-flex align-items-center justify-content-between p-2 mb-2 rounded border">
                        <div class="variation-info flex-grow-1">
                            <span class="variation-name fw-medium">{{ $tier->quantity_range }} units</span>
                            @if($tier->label)
                                <span class="badge badge-sm bg-info ms-2">{{ $tier->label }}</span>
                            @endif
                            @if($tier->discount_percent)
                                <span class="badge badge-sm bg-success ms-2">{{ $tier->discount_percent }}% off</span>
                            @endif
                        </div>
                        <div class="variation-price text-end" style="min-width: 100px;">
                            <span class="price">${{ number_format($tier->price, 2) }} each</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    <small class="text-muted">Prices automatically apply based on total quantity ordered.</small>
@endif
