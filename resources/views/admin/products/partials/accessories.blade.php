@php
    $accessoryTypes = \App\Models\AccessoryType::with('accessories')->where('published', true)->orderBy('sort_order')->get();
    $selectedAccessoryIds = $product->accessories->pluck('id')->toArray();
    // Get which accessory types have selected accessories
    $selectedTypeIds = $product->accessories->pluck('accessory_type_id')->unique()->toArray();
@endphp

<div class="card card-primary mb-3">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-puzzle-piece mr-2"></i>Product Accessories</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Select which accessory types are available for this product, then choose specific accessories.</p>

        @if($accessoryTypes->count() > 0)
            <div class="form-group">
                <label for="accessoryTypeSelect">Accessory Types</label><br>
                <select id="accessoryTypeSelect" class="form-control select2" multiple style="width: 100%;">
                    @foreach($accessoryTypes as $accessoryType)
                        @if($accessoryType->accessories->where('published', true)->count() > 0)
                            <option value="{{ $accessoryType->id }}" {{ in_array($accessoryType->id, $selectedTypeIds) ? 'selected' : '' }}>
                                {{ $accessoryType->name }} ({{ $accessoryType->accessories->where('published', true)->count() }} items)
                            </option>
                        @endif
                    @endforeach
                </select>
                <small class="form-text text-muted">Select accessory types to show their items below.</small>
            </div>

            <div id="accessoryTypeSections">
                @foreach($accessoryTypes as $accessoryType)
                    @if($accessoryType->accessories->where('published', true)->count() > 0)
                        <div class="accessory-type-section table-responsive mb-3" 
                             data-type-id="{{ $accessoryType->id }}" 
                             style="{{ in_array($accessoryType->id, $selectedTypeIds) ? '' : 'display:none;' }}">
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th style="width: 60px;" class="text-center">Active</th>
                                        <th>{{ $accessoryType->name }}</th>
                                        <th style="width: 100px;">SKU</th>
                                        <th style="width: 80px;">Price</th>
                                        <th style="width: 80px;" class="text-center" title="Pre-selected by default">Default</th>
                                        <th style="width: 100px;" class="text-center" title="Included in product price (no extra charge)">Included in Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accessoryType->accessories->where('published', true)->sortBy('sort_order') as $accessory)
                                        @php
                                            $isSelected = in_array($accessory->id, $selectedAccessoryIds);
                                            $pivot = $product->accessories->where('id', $accessory->id)->first()?->pivot;
                                        @endphp
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" 
                                                    name="accessories[]" 
                                                    value="{{ $accessory->id }}" 
                                                    class="accessory-checkbox"
                                                    data-accessory-id="{{ $accessory->id }}"
                                                    {{ $isSelected ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                {{ $accessory->name }}
                                                @if($accessory->description)
                                                    <small class="text-muted d-block">{{ Str::limit($accessory->description, 50) }}</small>
                                                @endif
                                            </td>
                                            <td><small>{{ $accessory->sku ?? '-' }}</small></td>
                                            <td>{{ $accessory->base_price ? '$' . number_format($accessory->base_price, 2) : '-' }}</td>
                                            <td class="text-center">
                                                <input type="checkbox" 
                                                    name="accessory_defaults[{{ $accessory->id }}]" 
                                                    value="1"
                                                    class="accessory-default"
                                                    data-accessory-id="{{ $accessory->id }}"
                                                    {{ $pivot?->is_default ? 'checked' : '' }}
                                                    {{ !$isSelected ? 'disabled' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" 
                                                    name="accessory_included[{{ $accessory->id }}]" 
                                                    value="1"
                                                    class="accessory-included"
                                                    data-accessory-id="{{ $accessory->id }}"
                                                    {{ $pivot?->included_in_price ? 'checked' : '' }}
                                                    {{ !$isSelected ? 'disabled' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endforeach
            </div>

            <div id="noAccessoryTypesSelected" class="alert alert-secondary" style="{{ count($selectedTypeIds) > 0 ? 'display:none;' : '' }}">
                <i class="fas fa-info-circle mr-1"></i>
                Select accessory types above to configure which accessories are available for this product.
            </div>
        @else
            <div class="alert alert-info">
                No accessory types have been created yet. 
                <a href="{{ route('admin.accessory-types.create') }}">Create an accessory type</a> first, 
                then <a href="{{ route('admin.accessories.create') }}">add accessories</a>.
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 for accessory type select
    $('#accessoryTypeSelect').select2({
        placeholder: 'Select accessory types...',
        allowClear: true
    });

    // Show/hide accessory type sections based on selection
    $('#accessoryTypeSelect').on('change', function() {
        var selectedTypes = $(this).val() || [];
        
        // Hide all sections first
        $('.accessory-type-section').hide();
        
        // Show selected sections
        selectedTypes.forEach(function(typeId) {
            $('.accessory-type-section[data-type-id="' + typeId + '"]').show();
        });
        
        // Show/hide the "no types selected" message
        if (selectedTypes.length > 0) {
            $('#noAccessoryTypesSelected').hide();
        } else {
            $('#noAccessoryTypesSelected').show();
            // Uncheck all accessories when no types selected
            $('.accessory-checkbox').prop('checked', false).trigger('change');
        }
    });

    // Enable/disable default and included checkboxes based on accessory selection
    $(document).on('change', '.accessory-checkbox', function() {
        var accessoryId = $(this).data('accessory-id');
        var defaultCheckbox = $('.accessory-default[data-accessory-id="' + accessoryId + '"]');
        var includedCheckbox = $('.accessory-included[data-accessory-id="' + accessoryId + '"]');
        
        if ($(this).is(':checked')) {
            defaultCheckbox.prop('disabled', false);
            includedCheckbox.prop('disabled', false);
        } else {
            defaultCheckbox.prop('disabled', true).prop('checked', false);
            includedCheckbox.prop('disabled', true).prop('checked', false);
        }
    });
});
</script>
@endpush
