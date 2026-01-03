{{-- Pricing Tab - SKU, UPC, Prices, Quantities per variation --}}
<div class="card card-success mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-dollar-sign mr-2"></i>Product Pricing</h5>
    </div>
    <div class="card-body">
        @if(isset($product) && $product->variations && $product->variations->count() > 0)
            <p class="text-muted">Pricing details for each variation. Edit SKU, UPC, prices, and quantities below.</p>

            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="pricingTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 140px;">Variation</th>
                            <th style="width: 90px;">SKU</th>
                            <th style="width: 90px;">UPC</th>
                            <th style="width: 95px;">Current Price</th>
                            <th style="width: 95px;">Full Price</th>
                            <th style="width: 70px;">Qty</th>
                            <th style="width: 80px;">QB1</th>
                            <th style="width: 80px;">QB2</th>
                        </tr>
                    </thead>
                    <tbody id="pricingBody">
                        @foreach($product->variations as $index => $variation)
                            <tr class="pricing-row" data-index="{{ $index }}">
                                <td>
                                    <input type="hidden" name="variations[{{ $index }}][id]" value="{{ $variation->id }}">
                                    <input type="hidden" name="variations[{{ $index }}][name]" value="{{ $variation->name }}">
                                    <strong>{{ $variation->name }}</strong>
                                    @if($variation->description)
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
                            <td colspan="5" class="text-right"><strong>Total Quantity:</strong></td>
                            <td><input type="text" id="totalQuantity" class="form-control form-control-sm bg-light" readonly></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="alert alert-info mt-3 mb-0">
                <i class="fas fa-info-circle mr-1"></i>
                To add or remove variations, go to the <strong>Variations</strong> tab.
            </div>
        @else
            {{-- No variations - show base product pricing --}}
            <p class="text-muted">Set base pricing for this product. Add variations in the Variations tab if this product has multiple sizes/styles.</p>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" name="sku" id="sku" class="form-control" value="{{ old('sku', $product->sku) }}" placeholder="Internal code">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="upc_code">UPC Code</label>
                        <input type="text" name="upc_code" id="upc_code" class="form-control" value="{{ old('upc_code', $product->upc_code) }}" placeholder="For order tickets">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="base_price">Current Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="number" step="0.01" name="base_price" id="base_price" class="form-control" value="{{ old('base_price', $product->base_price) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="full_price">Full Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="number" step="0.01" name="full_price" id="full_price" class="form-control" value="{{ old('full_price', $product->full_price) }}">
                        </div>
                        <small class="text-muted">Strikethrough price</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $product->quantity ?? 0) }}" min="0">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="base_cost">Base Cost</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="number" step="0.01" name="base_cost" id="base_cost" class="form-control" value="{{ old('base_cost', $product->base_cost) }}">
                        </div>
                        <small class="text-muted">Your cost (internal)</small>
                    </div>
                </div>
                @can('setting_edit')
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="qb_1">QuickBooks ID 1</label>
                        <input type="text" name="qb_1" id="qb_1" class="form-control" value="{{ old('qb_1', $product->qb_1) }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="qb_2">QuickBooks ID 2</label>
                        <input type="text" name="qb_2" id="qb_2" class="form-control" value="{{ old('qb_2', $product->qb_2) }}">
                    </div>
                </div>
                @endcan
            </div>
        @endif
    </div>
</div>

{{-- Quantity Price Tiers --}}
<div class="card card-info mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-layer-group mr-2"></i>Quantity Price Tiers</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Set tiered pricing based on order quantity. Example: 1-49 @ $5.00, 50-99 @ $4.50, 100+ @ $4.00</p>

        <table class="table table-bordered table-sm" id="priceTiersTable">
            <thead class="thead-light">
                <tr>
                    <th style="width: 120px;">Min Qty</th>
                    <th style="width: 120px;">Max Qty</th>
                    <th style="width: 120px;">Price Each</th>
                    <th>Label (optional)</th>
                    <th style="width: 50px;"></th>
                </tr>
            </thead>
            <tbody id="priceTiersBody">
                @if(isset($product) && $product->priceTiers)
                    @foreach($product->priceTiers as $index => $tier)
                        <tr class="price-tier-row" data-index="{{ $index }}">
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
                                <input type="text" name="price_tiers[{{ $index }}][label]" class="form-control form-control-sm" value="{{ $tier->label }}" placeholder="e.g., Bulk, Wholesale">
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
