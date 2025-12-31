@php
    $accessoryTypes = \App\Models\AccessoryType::with('accessories')->where('published', true)->orderBy('sort_order')->get();
    $selectedAccessoryIds = $product->accessories->pluck('id')->toArray();
@endphp

<div class="form-group">
    <h5>Available Accessories</h5>
    <p class="text-muted">Select which accessories can be added to this product when ordering.</p>
</div>

@if($accessoryTypes->count() > 0)
    @foreach($accessoryTypes as $accessoryType)
        @if($accessoryType->accessories->count() > 0)
            <div class="card mb-3">
                <div class="card-header">
                    <strong>{{ $accessoryType->name }}</strong>
                    @if($accessoryType->description)
                        <small class="text-muted d-block">{{ $accessoryType->description }}</small>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th width="50">Select</th>
                                    <th>Accessory</th>
                                    <th>SKU</th>
                                    <th>Base Price</th>
                                    <th width="80">Default</th>
                                    <th width="80">Required</th>
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
                                        <td>{{ $accessory->sku ?? '-' }}</td>
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
                                                name="accessory_required[{{ $accessory->id }}]" 
                                                value="1"
                                                class="accessory-required"
                                                data-accessory-id="{{ $accessory->id }}"
                                                {{ $pivot?->is_required ? 'checked' : '' }}
                                                {{ !$isSelected ? 'disabled' : '' }}>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@else
    <div class="alert alert-info">
        No accessory types have been created yet. 
        <a href="{{ route('admin.accessory-types.create') }}">Create an accessory type</a> first, 
        then <a href="{{ route('admin.accessories.create') }}">add accessories</a>.
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enable/disable default and required checkboxes based on accessory selection
    document.querySelectorAll('.accessory-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const accessoryId = this.dataset.accessoryId;
            const defaultCheckbox = document.querySelector(`.accessory-default[data-accessory-id="${accessoryId}"]`);
            const requiredCheckbox = document.querySelector(`.accessory-required[data-accessory-id="${accessoryId}"]`);
            
            if (this.checked) {
                defaultCheckbox.disabled = false;
                requiredCheckbox.disabled = false;
            } else {
                defaultCheckbox.disabled = true;
                defaultCheckbox.checked = false;
                requiredCheckbox.disabled = true;
                requiredCheckbox.checked = false;
            }
        });
    });
});
</script>
