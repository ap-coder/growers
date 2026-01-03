{{-- Pricing Tab - SKU, UPC, Prices, Quantities per variation --}}

{{-- Base Product Pricing - Always Show --}}
<div class="card card-success mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-dollar-sign mr-2"></i>Base Product Pricing</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="sku">SKU</label>
                    <input type="text" name="sku" id="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}" placeholder="Internal code">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="upc_code">UPC Code</label>
                    <input type="text" name="upc_code" id="upc_code" class="form-control" value="{{ old('upc_code', $product->upc_code ?? '') }}" placeholder="For order tickets">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="base_price">Current Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                        <input type="number" step="0.01" name="base_price" id="base_price" class="form-control" value="{{ old('base_price', $product->base_price ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="full_price">Full Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                        <input type="number" step="0.01" name="full_price" id="full_price" class="form-control" value="{{ old('full_price', $product->full_price ?? '') }}">
                    </div>
                    <small class="text-muted">Strikethrough</small>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="base_cost">Base Cost</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                        <input type="number" step="0.01" name="base_cost" id="base_cost" class="form-control" value="{{ old('base_cost', $product->base_cost ?? '') }}">
                    </div>
                    <small class="text-muted">Your cost</small>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $product->quantity ?? 0) }}" min="0">
                </div>
            </div>
        </div>
        @can('setting_edit')
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="qb_1">QuickBooks ID 1</label>
                    <input type="text" name="qb_1" id="qb_1" class="form-control" value="{{ old('qb_1', $product->qb_1 ?? '') }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="qb_2">QuickBooks ID 2</label>
                    <input type="text" name="qb_2" id="qb_2" class="form-control" value="{{ old('qb_2', $product->qb_2 ?? '') }}">
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>

{{-- Variation Pricing --}}
<div class="card card-info mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-th-list mr-2"></i>Variation Pricing</h5>
    </div>
    <div class="card-body">
        @if(isset($product) && $product->variations && $product->variations->count() > 0)
            <p class="text-muted">Pricing details for each variation. Edit SKU, UPC, prices, cost, and quantities below.</p>

            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="pricingTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 130px;">Variation</th>
                            <th style="width: 85px;">SKU</th>
                            <th style="width: 85px;">UPC</th>
                            <th style="width: 90px;">Price</th>
                            <th style="width: 90px;">Full Price</th>
                            <th style="width: 90px;">Cost</th>
                            <th style="width: 60px;">Qty</th>
                            <th style="width: 70px;">QB1</th>
                            <th style="width: 70px;">QB2</th>
                        </tr>
                    </thead>
                    <tbody id="pricingBody">
                        @foreach($product->variations as $index => $variation)
                            <tr class="pricing-row" data-index="{{ $index }}">
                                <td>
                                    <strong>{{ $variation->name }}</strong>
                                    @if($variation->variationCategory)
                                        <small class="text-muted d-block">{{ $variation->variationCategory->name }}</small>
                                    @elseif($variation->description)
                                        <small class="text-muted d-block">{{ $variation->description }}</small>
                                    @endif
                                </td>
                                <td>
                                    <input type="text" name="variations[{{ $index }}][sku]" class="form-control form-control-sm" value="{{ $variation->sku }}" placeholder="SKU">
                                </td>
                                <td>
                                    <input type="text" name="variations[{{ $index }}][upc_code]" class="form-control form-control-sm" value="{{ $variation->upc_code }}" placeholder="UPC">
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="number" step="0.01" name="variations[{{ $index }}][base_price]" class="form-control" value="{{ $variation->base_price }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="number" step="0.01" name="variations[{{ $index }}][full_price]" class="form-control" value="{{ $variation->full_price }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="number" step="0.01" name="variations[{{ $index }}][base_cost]" class="form-control" value="{{ $variation->base_cost }}">
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="variations[{{ $index }}][quantity]" class="form-control form-control-sm pricing-qty" value="{{ $variation->quantity ?? 0 }}" min="0">
                                </td>
                                <td>
                                    <input type="text" name="variations[{{ $index }}][qb_1]" class="form-control form-control-sm" value="{{ $variation->qb_1 }}" placeholder="QB1">
                                </td>
                                <td>
                                    <input type="text" name="variations[{{ $index }}][qb_2]" class="form-control form-control-sm" value="{{ $variation->qb_2 }}" placeholder="QB2">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-light">
                        <tr>
                            <td colspan="6" class="text-right"><strong>Total Quantity:</strong></td>
                            <td><input type="text" id="totalQuantity" class="form-control form-control-sm bg-light" readonly></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="alert alert-secondary mt-3 mb-0">
                <i class="fas fa-info-circle mr-1"></i>
                To add or remove variations, go to the <strong>Variations</strong> tab.
            </div>
        @else
            <p class="text-muted">No variations defined. Add variations in the Variations tab if this product has multiple sizes/styles.</p>
        @endif
    </div>
</div>

{{-- Quantity Price Tiers --}}
@php
    // Get existing unique price tier configurations for quick-add
    $existingTiers = \App\Models\ProductPriceTier::select('min_quantity', 'max_quantity', 'label', 'tier_group')
        ->groupBy('min_quantity', 'max_quantity', 'label', 'tier_group')
        ->orderBy('tier_group')
        ->orderBy('min_quantity')
        ->get();
    
    // Get unique tier groups for grouping
    $tierGroups = \App\Models\ProductPriceTier::whereNotNull('tier_group')
        ->distinct()
        ->pluck('tier_group')
        ->toArray();
@endphp
<div class="card card-info mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-layer-group mr-2"></i>Quantity Price Tiers</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Set tiered pricing based on order quantity. Example: 1-49 @ $5.00, 50-99 @ $4.50, 100+ @ $4.00</p>

        {{-- Quick Add from Existing --}}
        @if($existingTiers->count() > 0)
        <div class="card card-outline card-info mb-3">
            <div class="card-header py-2">
                <h6 class="mb-0"><i class="fas fa-bolt mr-1"></i> Quick Add from Existing Tiers</h6>
            </div>
            <div class="card-body py-2">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label class="form-label small">Tier Group</label>
                        <select id="quickAddTierGroup" class="form-control form-control-sm">
                            <option value="">-- Select or Enter Group --</option>
                            @foreach($tierGroups as $group)
                                <option value="{{ $group }}">{{ $group }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small">Tier Range</label>
                        <select id="quickAddTier" class="form-control form-control-sm">
                            <option value="">-- Select Existing Tier --</option>
                            @foreach($existingTiers->groupBy('tier_group') as $groupName => $groupTiers)
                                @if($groupName)
                                    <optgroup label="{{ $groupName }}">
                                @endif
                                @foreach($groupTiers as $tier)
                                    <option value="{{ $tier->min_quantity }}-{{ $tier->max_quantity ?? '' }}" 
                                            data-min="{{ $tier->min_quantity }}" 
                                            data-max="{{ $tier->max_quantity }}"
                                            data-label="{{ $tier->label }}"
                                            data-group="{{ $tier->tier_group }}">
                                        {{ $tier->min_quantity }}{{ $tier->max_quantity ? '-' . $tier->max_quantity : '+' }} 
                                        @if($tier->label) ({{ $tier->label }}) @endif
                                    </option>
                                @endforeach
                                @if($groupName)
                                    </optgroup>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">Price</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="number" step="0.01" id="quickAddTierPrice" class="form-control" placeholder="0.00">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label small">&nbsp;</label>
                        <button type="button" class="btn btn-info btn-sm btn-block" id="quickAddTierBtn" disabled>
                            <i class="fas fa-plus mr-1"></i> Add
                        </button>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label small">&nbsp;</label>
                        <button type="button" class="btn btn-success btn-sm btn-block" id="bulkAddGroupBtn" disabled title="Add all tiers from selected group">
                            <i class="fas fa-plus-circle mr-1"></i> Add All
                        </button>
                    </div>
                </div>
                <small class="text-muted">Select a tier group to add individual tiers, or click "Add All" to add all tiers from that group at once.</small>
            </div>
        </div>
        @endif

        <table class="table table-bordered table-sm" id="priceTiersTable">
            <thead class="thead-light">
                <tr>
                    <th style="width: 130px;">Tier Group</th>
                    <th style="width: 90px;">Min Qty</th>
                    <th style="width: 90px;">Max Qty</th>
                    <th style="width: 100px;">Price Each</th>
                    <th style="width: 90px;">Discount %</th>
                    <th>Label</th>
                    <th style="width: 50px;"></th>
                </tr>
            </thead>
            <tbody id="priceTiersBody">
                @if(isset($product) && $product->priceTiers)
                    @foreach($product->priceTiers as $index => $tier)
                        <tr class="price-tier-row" data-index="{{ $index }}">
                            <td>
                                <input type="text" name="price_tiers[{{ $index }}][tier_group]" class="form-control form-control-sm" value="{{ $tier->tier_group }}" placeholder="Group name">
                            </td>
                            <td>
                                <input type="number" name="price_tiers[{{ $index }}][min_quantity]" class="form-control form-control-sm" value="{{ $tier->min_quantity }}" min="1">
                            </td>
                            <td>
                                <input type="number" name="price_tiers[{{ $index }}][max_quantity]" class="form-control form-control-sm" value="{{ $tier->max_quantity }}" placeholder="No limit">
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                    <input type="number" step="0.01" name="price_tiers[{{ $index }}][price]" class="form-control" value="{{ $tier->price }}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="number" step="0.01" name="price_tiers[{{ $index }}][discount_percent]" class="form-control" value="{{ $tier->discount_percent }}" placeholder="0">
                                    <div class="input-group-append"><span class="input-group-text">%</span></div>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="price_tiers[{{ $index }}][label]" class="form-control form-control-sm" value="{{ $tier->label }}" placeholder="Label">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-tier-btn">&times;</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <button type="button" class="btn btn-outline-success btn-sm mt-3" id="addPriceTierBtn">
            <i class="fas fa-plus mr-1"></i> Add Price Tier
        </button>
    </div>
</div>
