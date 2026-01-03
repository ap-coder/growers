{{-- Variations Tab - Define size/style variations --}}
@php
    $variationCategories = \App\Models\VariationCategory::where('published', true)->orderBy('sort_order')->get();
    // Get existing unique variations grouped by category for quick-add
    $existingVariations = \App\Models\ProductVariation::select('variation_category_id', 'name', 'description')
        ->whereNotNull('variation_category_id')
        ->where('name', '!=', '')
        ->groupBy('variation_category_id', 'name', 'description')
        ->orderBy('variation_category_id')
        ->orderBy('name')
        ->get()
        ->groupBy('variation_category_id');
@endphp
<div class="card card-primary mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-th-list mr-2"></i>Product Variations</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Define variations for this product grouped by category (Size, Color, Material, etc.). Each variation can have its own pricing in the Pricing tab.</p>

        {{-- Quick Add from Existing --}}
        <div class="card card-outline card-info mb-3">
            <div class="card-header py-2">
                <h6 class="mb-0"><i class="fas fa-bolt mr-1"></i> Quick Add from Existing</h6>
            </div>
            <div class="card-body py-2">
                <div class="row">
                    <div class="col-md-4">
                        <select id="quickAddCategory" class="form-control form-control-sm">
                            <option value="">-- Select Category --</option>
                            @foreach($variationCategories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select id="quickAddVariation" class="form-control form-control-sm" disabled>
                            <option value="">-- Select a category first --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-info btn-sm btn-block" id="quickAddBtn" disabled>
                            <i class="fas fa-plus mr-1"></i> Add Selected
                        </button>
                    </div>
                </div>
                <small class="text-muted mt-1 d-block">Select from variations already used on other products to maintain consistency.</small>
            </div>
        </div>

        <table class="table table-bordered table-sm" id="variationsTable">
            <thead class="thead-light">
                <tr>
                    <th style="width: 50px;">Active</th>
                    <th style="width: 150px;">Category</th>
                    <th style="width: 150px;">Variation Name</th>
                    <th>Description</th>
                    <th style="width: 80px;">Qty</th>
                    <th style="width: 60px;" title="Show quantity on frontend">Show</th>
                    <th style="width: 50px;"></th>
                </tr>
            </thead>
            <tbody id="variationsBody">
                @if(isset($product) && $product->variations && $product->variations->count() > 0)
                    @foreach($product->variations as $index => $variation)
                        <tr class="variation-row" data-index="{{ $index }}">
                            <td class="text-center">
                                <input type="hidden" name="variations[{{ $index }}][active]" value="0">
                                <input type="checkbox" name="variations[{{ $index }}][active]" value="1" {{ old('variations.'.$index.'.active', $variation->active ?? 1) ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input type="hidden" name="variations[{{ $index }}][id]" value="{{ $variation->id }}">
                                <select name="variations[{{ $index }}][variation_category_id]" class="form-control form-control-sm">
                                    <option value="">-- Select --</option>
                                    @foreach($variationCategories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('variations.'.$index.'.variation_category_id', $variation->variation_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="variations[{{ $index }}][name]" class="form-control form-control-sm" value="{{ $variation->name }}" placeholder="e.g., Small 8&quot;" required>
                            </td>
                            <td>
                                <input type="text" name="variations[{{ $index }}][description]" class="form-control form-control-sm" value="{{ $variation->description ?? '' }}" placeholder="Optional description">
                            </td>
                            <td>
                                <input type="number" name="variations[{{ $index }}][quantity]" class="form-control form-control-sm" value="{{ $variation->quantity ?? 0 }}" min="0">
                            </td>
                            <td class="text-center">
                                <input type="hidden" name="variations[{{ $index }}][show_quantity]" value="0">
                                <input type="checkbox" name="variations[{{ $index }}][show_quantity]" value="1" {{ old('variations.'.$index.'.show_quantity', $variation->show_quantity ?? 0) ? 'checked' : '' }}>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-variation-btn" title="Remove">&times;</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <button type="button" class="btn btn-outline-success btn-sm mt-3" id="addVariationBtn">
            <i class="fas fa-plus mr-1"></i> Add New Variation
        </button>
        <a href="{{ route('admin.variation-categories.index') }}" class="btn btn-outline-secondary btn-sm mt-3 ml-2" target="_blank">
            <i class="fas fa-cog mr-1"></i> Manage Categories
        </a>

        <div class="alert alert-secondary mt-3 mb-0">
            <i class="fas fa-info-circle mr-1"></i>
            <strong>Tip:</strong> After adding variations here, go to the <strong>Pricing</strong> tab to set SKU, UPC, prices, and quantities for each variation. Uncheck "Active" to hide a variation from customers.
        </div>
    </div>
</div>

{{-- Existing variations data for JavaScript --}}
<script>
window.existingVariationsByCategory = @json($existingVariations);
</script>
