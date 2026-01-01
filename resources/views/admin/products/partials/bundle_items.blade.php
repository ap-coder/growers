<!-- Overall Bundle Pricing -->
<div class="card card-success mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-dollar-sign mr-2"></i>Bundle Pricing</h5>
    </div>
    <div class="card-body">
        <p class="text-muted mb-3">Set how the overall bundle price is calculated. You can also adjust individual item prices below.</p>
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="bundle_price_type">Bundle Price Method</label>
                    <select class="form-control" name="bundle_price_type" id="bundle_price_type">
                        @foreach(\App\Models\Product::BUNDLE_PRICE_TYPES as $key => $label)
                            <option value="{{ $key }}" {{ old('bundle_price_type', $product->bundle_price_type ?? 'calculated') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4" id="bundle_price_override_group" style="{{ ($product->bundle_price_type ?? 'calculated') == 'fixed' ? '' : 'display:none;' }}">
                <div class="form-group">
                    <label for="bundle_price_override">Fixed Bundle Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                        <input type="number" step="0.01" class="form-control" name="bundle_price_override" id="bundle_price_override" value="{{ old('bundle_price_override', $product->bundle_price_override) }}" placeholder="0.00">
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="bundle_discount_group" style="{{ in_array($product->bundle_price_type ?? 'calculated', ['discount_percent', 'discount_amount']) ? '' : 'display:none;' }}">
                <div class="form-group">
                    <label for="bundle_discount" id="bundle_discount_label">Discount</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text" id="bundle_discount_symbol">%</span></div>
                        <input type="number" step="0.01" class="form-control" name="bundle_discount" id="bundle_discount" value="{{ old('bundle_discount', $product->bundle_discount) }}" placeholder="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bundle Items (for Set/Bundle products) -->
<div class="card card-info mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-box-open mr-2"></i>Bundle Contents</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Define which products are included in this set/bundle. You can create groups for customer selection and set custom pricing for bundle items.</p>
        
        <div id="bundleItemsContainer">
            @php
                $bundleItems = $product->bundleItems ?? collect();
                $groupedItems = $bundleItems->groupBy('group_name');
                $allProducts = \App\Models\Product::where('id', '!=', $product->id)->orderBy('name')->get();
            @endphp

            @foreach($groupedItems as $groupName => $items)
                <div class="bundle-group card mb-3">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <input type="text" class="form-control form-control-sm w-50 group-name-input" 
                               name="bundle_groups[{{ $loop->index }}][name]" 
                               value="{{ $groupName ?: 'Default' }}" 
                               placeholder="Group name (e.g., Choose your basket)">
                        <button type="button" class="btn btn-sm btn-danger remove-group-btn">
                            <i class="fas fa-trash"></i> Remove Group
                        </button>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-2">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="min-width: 200px;">Product</th>
                                        <th width="60">Qty</th>
                                        <th width="120">Pricing</th>
                                        <th width="100">Price</th>
                                        <th width="70">Req.</th>
                                        <th width="70">Select</th>
                                        <th width="40"></th>
                                    </tr>
                                </thead>
                                <tbody class="bundle-items-body">
                                    @foreach($items as $item)
                                        <tr class="bundle-item-row">
                                            <td>
                                                <select name="bundle_groups[{{ $loop->parent->index }}][items][{{ $loop->index }}][product_id]" 
                                                        class="form-control form-control-sm bundle-product-select" 
                                                        data-base-price="{{ $item->itemProduct?->base_price ?? 0 }}">
                                                    <option value="">-- Select Product --</option>
                                                    @foreach($allProducts as $p)
                                                        <option value="{{ $p->id }}" 
                                                                data-price="{{ $p->base_price }}"
                                                                {{ $item->item_product_id == $p->id ? 'selected' : '' }}>
                                                            {{ $p->name }} (${{ number_format($p->base_price ?? 0, 2) }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="bundle_groups[{{ $loop->parent->index }}][items][{{ $loop->index }}][quantity]" 
                                                       class="form-control form-control-sm" value="{{ $item->quantity }}" min="1">
                                            </td>
                                            <td>
                                                <select name="bundle_groups[{{ $loop->parent->index }}][items][{{ $loop->index }}][price_type]" 
                                                        class="form-control form-control-sm price-type-select">
                                                    @foreach(\App\Models\ProductBundleItem::PRICE_TYPES as $key => $label)
                                                        <option value="{{ $key }}" {{ ($item->price_type ?? 'default') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <div class="price-input-wrapper">
                                                    <div class="input-group input-group-sm price-override-group" style="{{ ($item->price_type ?? 'default') == 'override' ? '' : 'display:none;' }}">
                                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                                        <input type="number" step="0.01" name="bundle_groups[{{ $loop->parent->index }}][items][{{ $loop->index }}][price_override]" 
                                                               class="form-control" value="{{ $item->price_override }}" placeholder="0.00">
                                                    </div>
                                                    <div class="input-group input-group-sm price-adjustment-group" style="{{ ($item->price_type ?? 'default') == 'adjustment' ? '' : 'display:none;' }}">
                                                        <div class="input-group-prepend"><span class="input-group-text">+/-</span></div>
                                                        <input type="number" step="0.01" name="bundle_groups[{{ $loop->parent->index }}][items][{{ $loop->index }}][price_adjustment]" 
                                                               class="form-control" value="{{ $item->price_adjustment }}" placeholder="0.00">
                                                    </div>
                                                    <span class="price-default-text text-muted small" style="{{ in_array($item->price_type ?? 'default', ['default', 'free']) ? '' : 'display:none;' }}">
                                                        {{ ($item->price_type ?? 'default') == 'free' ? 'Free' : 'Base' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="bundle_groups[{{ $loop->parent->index }}][items][{{ $loop->index }}][is_required]" 
                                                       value="1" {{ $item->is_required ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="bundle_groups[{{ $loop->parent->index }}][items][{{ $loop->index }}][is_selectable]" 
                                                       value="1" {{ $item->is_selectable ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-item-btn">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary add-item-btn">
                            <i class="fas fa-plus"></i> Add Item
                        </button>
                    </div>
                </div>
            @endforeach

            @if($bundleItems->isEmpty())
                <div class="bundle-group card mb-3">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <input type="text" class="form-control form-control-sm w-50 group-name-input" 
                               name="bundle_groups[0][name]" 
                               value="Default" 
                               placeholder="Group name">
                        <button type="button" class="btn btn-sm btn-danger remove-group-btn">
                            <i class="fas fa-trash"></i> Remove Group
                        </button>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-2">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="min-width: 200px;">Product</th>
                                        <th width="60">Qty</th>
                                        <th width="120">Pricing</th>
                                        <th width="100">Price</th>
                                        <th width="70">Req.</th>
                                        <th width="70">Select</th>
                                        <th width="40"></th>
                                    </tr>
                                </thead>
                                <tbody class="bundle-items-body">
                                    <tr class="bundle-item-row">
                                        <td>
                                            <select name="bundle_groups[0][items][0][product_id]" class="form-control form-control-sm bundle-product-select">
                                                <option value="">-- Select Product --</option>
                                                @foreach($allProducts as $p)
                                                    <option value="{{ $p->id }}" data-price="{{ $p->base_price }}">{{ $p->name }} (${{ number_format($p->base_price ?? 0, 2) }})</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="bundle_groups[0][items][0][quantity]" class="form-control form-control-sm" value="1" min="1">
                                        </td>
                                        <td>
                                            <select name="bundle_groups[0][items][0][price_type]" class="form-control form-control-sm price-type-select">
                                                @foreach(\App\Models\ProductBundleItem::PRICE_TYPES as $key => $label)
                                                    <option value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <div class="price-input-wrapper">
                                                <div class="input-group input-group-sm price-override-group" style="display:none;">
                                                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                                    <input type="number" step="0.01" name="bundle_groups[0][items][0][price_override]" class="form-control" placeholder="0.00">
                                                </div>
                                                <div class="input-group input-group-sm price-adjustment-group" style="display:none;">
                                                    <div class="input-group-prepend"><span class="input-group-text">+/-</span></div>
                                                    <input type="number" step="0.01" name="bundle_groups[0][items][0][price_adjustment]" class="form-control" placeholder="0.00">
                                                </div>
                                                <span class="price-default-text text-muted small">Base</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="bundle_groups[0][items][0][is_required]" value="1" checked>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="bundle_groups[0][items][0][is_selectable]" value="1">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-item-btn">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary add-item-btn">
                            <i class="fas fa-plus"></i> Add Item
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <hr>
        <button type="button" class="btn btn-outline-success" id="addBundleGroupBtn">
            <i class="fas fa-plus"></i> Add New Group
        </button>
    </div>
</div>

<div class="card card-secondary">
    <div class="card-header">
        <h6 class="mb-0">Bundle Configuration Help</h6>
    </div>
    <div class="card-body">
        <ul class="mb-0">
            <li><strong>Group Name:</strong> Label for a selection group (e.g., "Choose your basket", "Select a plant")</li>
            <li><strong>Required:</strong> Item must be included in the bundle</li>
            <li><strong>Selectable:</strong> Customer can choose from multiple options in this group</li>
            <li><strong>Example:</strong> A "Valentine's Set" might have:
                <ul>
                    <li>Group "Choose your basket" with 3 basket options (selectable, required)</li>
                    <li>Group "Choose your plant" with 5 plant options (selectable, required)</li>
                    <li>Group "Add-ons" with card holder, ribbon (selectable, not required)</li>
                </ul>
            </li>
        </ul>
    </div>
</div>
