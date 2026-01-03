<!-- Base Pricing & Identifiers (on Product) -->
<div class="card card-secondary mb-4">
    <div class="card-header">
        <h5 class="mb-0">Base Pricing & Identifiers</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="base_price">Sale Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control" type="number" step="0.01" name="base_price" id="base_price" value="{{ old('base_price', $product->base_price) }}">
                    </div>
                    <span class="help-block">Current selling price</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="full_price">Full Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control" type="number" step="0.01" name="full_price" id="full_price" value="{{ old('full_price', $product->full_price) }}">
                    </div>
                    <span class="help-block">Original price (strikethrough)</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="base_cost">Base Cost</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control" type="number" step="0.01" name="base_cost" id="base_cost" value="{{ old('base_cost', $product->base_cost) }}">
                    </div>
                    <span class="help-block">Your cost (internal)</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="sku">SKU</label>
                    <input class="form-control" type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}">
                    <span class="help-block">Internal product code</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="upc_code">UPC Code</label>
                    <input class="form-control" type="text" name="upc_code" id="upc_code" value="{{ old('upc_code', $product->upc_code) }}">
                    <span class="help-block">For order tickets</span>
                </div>
            </div>
            <div class="col-md-2" id="quantity_group">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input class="form-control bg-light" type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" step="1" readonly>
                    <span class="help-block">Stock on hand</span>
                </div>
            </div>
        </div>
        @can('setting_edit')
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="qb_1">QuickBooks ID 1</label>
                    <input class="form-control" type="text" name="qb_1" id="qb_1" value="{{ old('qb_1', $product->qb_1) }}">
                    <span class="help-block">Accounting identifier</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="qb_2">QuickBooks ID 2</label>
                    <input class="form-control" type="text" name="qb_2" id="qb_2" value="{{ old('qb_2', $product->qb_2) }}">
                    <span class="help-block">Accounting identifier</span>
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>

<!-- Product Variations (Sizes) -->
<div class="card card-primary mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-th-list mr-2"></i>Product Variations</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Add size or style variations. Each variation can have its own price, SKU, UPC code, and quantity. Leave empty if product has no variations.</p>
        <table class="table table-bordered" id="variationsTable">
            <thead>
                <tr>
                    <th>Variation Name</th>
                    <th style="width: 100px;">Price</th>
                    <th style="width: 100px;">Cost</th>
                    <th style="width: 80px;">Qty</th>
                    <th style="width: 100px;">SKU</th>
                    <th style="width: 100px;">UPC</th>
                    <th style="width: 60px;"></th>
                </tr>
            </thead>
            <tbody id="variationsBody">
                @if(isset($product) && $product->variations)
                    @foreach($product->variations as $index => $variation)
                        <tr class="variation-row" data-index="{{ $index }}">
                            <td>
                                <input type="hidden" name="variations[{{ $index }}][id]" value="{{ $variation->id }}">
                                <input type="text" name="variations[{{ $index }}][name]" class="form-control" value="{{ $variation->name }}" placeholder="e.g., Small 8&quot;" required>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" step="0.01" name="variations[{{ $index }}][base_price]" class="form-control" value="{{ $variation->base_price }}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" step="0.01" name="variations[{{ $index }}][base_cost]" class="form-control" value="{{ $variation->base_cost }}">
                                </div>
                            </td>
                            <td>
                                <input type="number" name="variations[{{ $index }}][quantity]" class="form-control form-control-sm variation-qty" value="{{ $variation->quantity ?? 0 }}" min="0">
                            </td>
                            <td>
                                <input type="text" name="variations[{{ $index }}][sku]" class="form-control form-control-sm" value="{{ $variation->sku }}">
                            </td>
                            <td>
                                <input type="text" name="variations[{{ $index }}][upc_code]" class="form-control form-control-sm" value="{{ $variation->upc_code }}">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm remove-variation-btn" title="Remove">&times;</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <button type="button" class="btn btn-success btn-sm" id="addVariationBtn">
            <i class="fas fa-plus"></i> Add Variation
        </button>
    </div>
</div>

<!-- Quantity-Based Price Tiers -->
<style>
    #priceTiersTable input[type="text"] { -moz-appearance: textfield; }
    #priceTiersTable input[type="text"]::-webkit-outer-spin-button,
    #priceTiersTable input[type="text"]::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    .tier-action-btn { width: 38px; height: 38px; font-size: 1.25rem; font-weight: bold; }
</style>
<div class="card card-info mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-layer-group mr-2"></i>Quantity Price Tiers</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Set tiered pricing based on order quantity. Example: 1-49 @ $5.00, 50-99 @ $4.50, 100-499 @ $4.00, 500+ @ $3.50</p>
        <table class="table table-bordered" id="priceTiersTable">
            <thead>
                <tr>
                    <th style="width: 150px;">Min Qty</th>
                    <th style="width: 150px;">Max Qty</th>
                    <th style="width: 150px;">Price Each</th>
                    <th>Label (optional)</th>
                    <th style="width: 60px;"></th>
                </tr>
            </thead>
            <tbody id="priceTiersBody">
                @if(isset($product) && $product->priceTiers)
                    @foreach($product->priceTiers as $index => $tier)
                        <tr class="price-tier-row" data-index="{{ $index }}">
                            <td>
                                <input type="text" name="price_tiers[{{ $index }}][min_quantity]" class="form-control text-right" value="{{ $tier->min_quantity }}" placeholder="e.g., 50" required>
                            </td>
                            <td>
                                <input type="text" name="price_tiers[{{ $index }}][max_quantity]" class="form-control text-right" value="{{ $tier->max_quantity }}" placeholder="No limit">
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" name="price_tiers[{{ $index }}][price]" class="form-control text-right" value="{{ $tier->price }}" required>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="price_tiers[{{ $index }}][label]" class="form-control" value="{{ $tier->label }}" placeholder="e.g., Retail, Bulk, Wholesale">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger tier-action-btn remove-tier-btn" title="Remove tier">&times;</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <button type="button" class="btn btn-success" id="addPriceTierBtn">
            <i class="fas fa-plus" style="font-size: 1rem;"></i> Add Price Tier
        </button>
    </div>
</div>

<!-- Select Clients Dropdown with Select2 (allows multiple selections) -->
<div class="form-group">
    <label for="clientSelect">Select Clients</label>
    <div class="input-group">
        <select id="clientSelect" class="form-control select2" name="clients[]" multiple style="width: 80%;">
            @foreach($clients as $client)
                <option style="width: 100%;" value="{{ $client->id }}" {{ (in_array($client->id, old('clients', $product->clients->pluck('id')->toArray()))) ? 'selected' : '' }}>
                    {{ $client->name }}
                </option>
            @endforeach
        </select>

        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="addClient">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <span class="help-block">Select clients to show product on.</span>
</div>

<!-- Client Price Overrides -->
<div id="clientPricingTableContainer" class="mt-3">
    <h5>Client Price Overrides</h5>
    <p class="text-muted">Only set a price if it differs from the base price above. Leave blank to use base price.</p>
    <table id="clientPricingTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Price Override</th>
            </tr>
        </thead>
        <tbody id="clientPricingTableBody">
            @foreach ($prices as $clientPrice)
                <tr id="pricing-row-{{ $clientPrice->client_id }}">
                    <td>{{ $clientPrice->client->name }}</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.01" name="client_prices[{{ $clientPrice->client_id }}][price]" class="form-control" value="{{ old('client_prices.' . $clientPrice->client_id . '.price', $clientPrice->price) }}" placeholder="Use base price">
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

