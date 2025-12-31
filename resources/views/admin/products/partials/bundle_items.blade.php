<!-- Bundle Items (for Set/Bundle products) -->
<div class="card card-info mb-4">
    <div class="card-header">
        <h5 class="mb-0">Bundle Contents</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Define which products are included in this set/bundle. You can create groups for customer selection (e.g., "Choose your basket").</p>
        
        <div id="bundleItemsContainer">
            @php
                $bundleItems = $product->bundleItems ?? collect();
                $groupedItems = $bundleItems->groupBy('group_name');
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
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th width="80">Qty</th>
                                    <th width="100">Required</th>
                                    <th width="100">Selectable</th>
                                    <th width="50"></th>
                                </tr>
                            </thead>
                            <tbody class="bundle-items-body">
                                @foreach($items as $item)
                                    <tr class="bundle-item-row">
                                        <td>
                                            <select name="bundle_groups[{{ $loop->parent->index }}][items][{{ $loop->index }}][product_id]" class="form-control form-control-sm select2-bundle">
                                                <option value="">-- Select Product --</option>
                                                @foreach(\App\Models\Product::where('id', '!=', $product->id)->orderBy('name')->get() as $p)
                                                    <option value="{{ $p->id }}" {{ $item->item_product_id == $p->id ? 'selected' : '' }}>
                                                        {{ $p->name }} ({{ ucfirst($p->product_type) }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="bundle_groups[{{ $loop->parent->index }}][items][{{ $loop->index }}][quantity]" 
                                                   class="form-control form-control-sm" value="{{ $item->quantity }}" min="1">
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
                        <button type="button" class="btn btn-sm btn-outline-primary add-item-btn">
                            <i class="fas fa-plus"></i> Add Item to Group
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
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th width="80">Qty</th>
                                    <th width="100">Required</th>
                                    <th width="100">Selectable</th>
                                    <th width="50"></th>
                                </tr>
                            </thead>
                            <tbody class="bundle-items-body">
                                <tr class="bundle-item-row">
                                    <td>
                                        <select name="bundle_groups[0][items][0][product_id]" class="form-control form-control-sm">
                                            <option value="">-- Select Product --</option>
                                            @foreach(\App\Models\Product::where('id', '!=', $product->id)->orderBy('name')->get() as $p)
                                                <option value="{{ $p->id }}">{{ $p->name }} ({{ ucfirst($p->product_type) }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="bundle_groups[0][items][0][quantity]" class="form-control form-control-sm" value="1" min="1">
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
                        <button type="button" class="btn btn-sm btn-outline-primary add-item-btn">
                            <i class="fas fa-plus"></i> Add Item to Group
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
