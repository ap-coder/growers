@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} Accessory
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.accessories.update", [$accessory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="accessory_type_id">Accessory Type</label>
                <select class="form-control select2 {{ $errors->has('accessory_type') ? 'is-invalid' : '' }}" name="accessory_type_id" id="accessory_type_id" required>
                    @foreach($accessoryTypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('accessory_type_id', $accessory->accessory_type_id) == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('accessory_type'))
                    <span class="text-danger">{{ $errors->first('accessory_type') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $accessory->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $accessory->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="sku">SKU</label>
                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text" name="sku" id="sku" value="{{ old('sku', $accessory->sku) }}">
                @if($errors->has('sku'))
                    <span class="text-danger">{{ $errors->first('sku') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="base_price">Base Price</label>
                <input class="form-control {{ $errors->has('base_price') ? 'is-invalid' : '' }}" type="number" name="base_price" id="base_price" value="{{ old('base_price', $accessory->base_price) }}" step="0.01">
                @if($errors->has('base_price'))
                    <span class="text-danger">{{ $errors->first('base_price') }}</span>
                @endif
                <span class="help-block">Default price if no client-specific price is set</span>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', $accessory->published) ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">Published</label>
                </div>
            </div>
            <div class="form-group">
                <label for="sort_order">Sort Order</label>
                <input class="form-control {{ $errors->has('sort_order') ? 'is-invalid' : '' }}" type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $accessory->sort_order) }}">
                @if($errors->has('sort_order'))
                    <span class="text-danger">{{ $errors->first('sort_order') }}</span>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Variants Section --}}
<div class="card">
    <div class="card-header bg-info">
        <h5 class="mb-0"><i class="fas fa-palette mr-2"></i>Color & Size Variants</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Add variants if this accessory comes in different colors or sizes with price differences.</p>
        
        <form method="POST" action="{{ route('admin.accessories.update', [$accessory->id]) }}" id="variants-form">
            @method('PUT')
            @csrf
            <input type="hidden" name="accessory_type_id" value="{{ $accessory->accessory_type_id }}">
            <input type="hidden" name="name" value="{{ $accessory->name }}">
            <input type="hidden" name="base_price" value="{{ $accessory->base_price }}">
            <input type="hidden" name="save_variants" value="1">
            
            <div class="table-responsive">
                <table class="table table-sm table-bordered" id="variantsTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 140px;">Name</th>
                            <th style="width: 90px;">Color</th>
                            <th style="width: 70px;">Size</th>
                            <th style="width: 100px;">Material</th>
                            <th style="width: 80px;">SKU</th>
                            <th style="width: 100px;">Price +/-</th>
                            <th style="width: 100px;">Fixed Price</th>
                            <th style="width: 40px;">Def</th>
                            <th style="width: 40px;">On</th>
                            <th style="width: 40px;"></th>
                        </tr>
                    </thead>
                    <tbody id="variantsBody">
                        @forelse($accessory->variants as $index => $variant)
                            <tr class="variant-row">
                                <td>
                                    <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
                                    <input type="text" class="form-control form-control-sm" name="variants[{{ $index }}][name]" value="{{ $variant->name }}" placeholder="e.g., Red Large">
                                </td>
                                <td><input type="text" class="form-control form-control-sm" name="variants[{{ $index }}][color]" value="{{ $variant->color }}" placeholder="Red"></td>
                                <td><input type="text" class="form-control form-control-sm" name="variants[{{ $index }}][size]" value="{{ $variant->size }}" placeholder="Large"></td>
                                <td>
                                    <select class="form-control form-control-sm" name="variants[{{ $index }}][material]">
                                        <option value="">--</option>
                                        @foreach(\App\Models\AccessoryVariant::MATERIALS as $key => $label)
                                            <option value="{{ $key }}" {{ $variant->material == $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm" name="variants[{{ $index }}][sku]" value="{{ $variant->sku }}"></td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="number" step="0.01" class="form-control" name="variants[{{ $index }}][price_adjustment]" value="{{ $variant->price_adjustment }}" placeholder="0.00">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="number" step="0.01" class="form-control" name="variants[{{ $index }}][price_override]" value="{{ $variant->price_override }}" placeholder="Override">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="default_variant" value="{{ $index }}" {{ $variant->is_default ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="variants[{{ $index }}][published]" value="1" {{ $variant->published ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-variant-btn"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr class="no-variants-row">
                                <td colspan="10" class="text-center text-muted py-3">
                                    No variants yet. Click "Add Variant" to create color/size options.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-2">
                <button type="button" class="btn btn-outline-primary btn-sm" id="addVariantBtn">
                    <i class="fas fa-plus mr-1"></i> Add Variant
                </button>
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="fas fa-save mr-1"></i> Save Variants
                </button>
            </div>
        </form>
    </div>
</div>

@if($clients->count() > 0)
<div class="card">
    <div class="card-header">
        Client-Specific Pricing
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.accessories.update", [$accessory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="accessory_type_id" value="{{ $accessory->accessory_type_id }}">
            <input type="hidden" name="name" value="{{ $accessory->name }}">
            <input type="hidden" name="base_price" value="{{ $accessory->base_price }}">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            @php
                                $clientPrice = $accessory->clientPrices->where('client_id', $client->id)->first();
                            @endphp
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>
                                    <input class="form-control" type="number" step="0.01" 
                                        name="client_prices[{{ $client->id }}][price]" 
                                        value="{{ old('client_prices.' . $client->id . '.price', $clientPrice->price ?? '') }}"
                                        placeholder="Use base price">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endif

@endsection

@section('scripts')
<script>
$(function() {
    var variantIndex = {{ $accessory->variants->count() }};
    
    // Add new variant row
    $('#addVariantBtn').on('click', function() {
        $('.no-variants-row').remove();
        
        var materialOptions = `<option value="">--</option>@foreach(\App\Models\AccessoryVariant::MATERIALS as $key => $label)<option value="{{ $key }}">{{ $label }}</option>@endforeach`;
        
        var newRow = `
            <tr class="variant-row">
                <td><input type="text" class="form-control form-control-sm" name="variants[${variantIndex}][name]" placeholder="e.g., Red Large"></td>
                <td><input type="text" class="form-control form-control-sm" name="variants[${variantIndex}][color]" placeholder="Red"></td>
                <td><input type="text" class="form-control form-control-sm" name="variants[${variantIndex}][size]" placeholder="Large"></td>
                <td><select class="form-control form-control-sm" name="variants[${variantIndex}][material]">${materialOptions}</select></td>
                <td><input type="text" class="form-control form-control-sm" name="variants[${variantIndex}][sku]"></td>
                <td>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                        <input type="number" step="0.01" class="form-control" name="variants[${variantIndex}][price_adjustment]" placeholder="0.00">
                    </div>
                </td>
                <td>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                        <input type="number" step="0.01" class="form-control" name="variants[${variantIndex}][price_override]" placeholder="Override">
                    </div>
                </td>
                <td class="text-center"><input type="radio" name="default_variant" value="${variantIndex}"></td>
                <td class="text-center"><input type="checkbox" name="variants[${variantIndex}][published]" value="1" checked></td>
                <td><button type="button" class="btn btn-sm btn-outline-danger remove-variant-btn"><i class="fas fa-times"></i></button></td>
            </tr>
        `;
        
        $('#variantsBody').append(newRow);
        variantIndex++;
    });
    
    // Remove variant row
    $(document).on('click', '.remove-variant-btn', function() {
        $(this).closest('tr').remove();
        
        if ($('#variantsBody .variant-row').length === 0) {
            $('#variantsBody').append(`
                <tr class="no-variants-row">
                    <td colspan="10" class="text-center text-muted py-3">
                        No variants yet. Click "Add Variant" to create color/size options.
                    </td>
                </tr>
            `);
        }
    });
});
</script>
@endsection
