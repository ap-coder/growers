{{-- Variations Tab - Define size/style variations --}}
@php
    $variationCategories = \App\Models\VariationCategory::where('published', true)->orderBy('sort_order')->get();
@endphp
<div class="card card-primary mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-th-list mr-2"></i>Product Variations</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Define variations for this product grouped by category (Size, Color, Material, etc.). Each variation can have its own pricing in the Pricing tab.</p>

        <table class="table table-bordered table-sm" id="variationsTable">
            <thead class="thead-light">
                <tr>
                    <th style="width: 50px;">Active</th>
                    <th style="width: 150px;">Category</th>
                    <th style="width: 180px;">Variation Name</th>
                    <th>Description</th>
                    <th style="width: 60px;"></th>
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
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-variation-btn" title="Remove">&times;</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <button type="button" class="btn btn-outline-success btn-sm mt-3" id="addVariationBtn">
            <i class="fas fa-plus mr-1"></i> Add Variation
        </button>
        <a href="{{ route('admin.variation-categories.index') }}" class="btn btn-outline-secondary btn-sm mt-3 ml-2" target="_blank">
            <i class="fas fa-cog mr-1"></i> Manage Categories
        </a>

        <div class="alert alert-info mt-3 mb-0">
            <i class="fas fa-info-circle mr-1"></i>
            <strong>Tip:</strong> After adding variations here, go to the <strong>Pricing</strong> tab to set SKU, UPC, prices, and quantities for each variation. Uncheck "Active" to hide a variation from customers.
        </div>
    </div>
</div>
