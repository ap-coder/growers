@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit mr-2"></i> Edit Collection: {{ $productCollection->name }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.product-collections.update', $productCollection) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="required" for="name">Collection Name</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $productCollection->name) }}" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="slug">Slug (URL)</label>
                        <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $productCollection->slug) }}">
                        @if($errors->has('slug'))
                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" rows="2">{{ old('description', $productCollection->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label class="required">Layout Style</label>
                <div class="row layout-selector">
                    @foreach($layouts as $key => $label)
                        <div class="col-md-3 col-sm-4 col-6 mb-3">
                            <label class="layout-option {{ old('layout_type', $productCollection->layout_type) == $key ? 'selected' : '' }}">
                                <input type="radio" name="layout_type" value="{{ $key }}" {{ old('layout_type', $productCollection->layout_type) == $key ? 'checked' : '' }} class="d-none">
                                <div class="layout-card">
                                    <img src="{{ asset('site/images/portfolio/icons/' . $layoutIcons[$key]) }}" alt="{{ $label }}">
                                    <span>{{ $label }}</span>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="columns">Columns (for grid layouts)</label>
                        <select class="form-control" name="columns" id="columns">
                            @for($i = 2; $i <= 6; $i++)
                                <option value="{{ $i }}" {{ old('columns', $productCollection->columns) == $i ? 'selected' : '' }}>{{ $i }} columns</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <input class="form-control" type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $productCollection->sort_order) }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="background_color">Background Color</label>
                        <input class="form-control" type="color" name="background_color" id="background_color" value="{{ old('background_color', $productCollection->background_color ?? '#ffffff') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="text_color">Text Color</label>
                        <input class="form-control" type="color" name="text_color" id="text_color" value="{{ old('text_color', $productCollection->text_color ?? '#333333') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="hidden" name="published" value="0">
                            <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', $productCollection->published) ? 'checked' : '' }}>
                            <label class="form-check-label" for="published">Published</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="hidden" name="show_on_homepage" value="0">
                            <input class="form-check-input" type="checkbox" name="show_on_homepage" id="show_on_homepage" value="1" {{ old('show_on_homepage', $productCollection->show_on_homepage) ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_on_homepage">Show on Homepage</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group">
                <label>Products in Collection</label>
                <select class="form-control select2" name="products[]" id="products" multiple>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $productCollection->products->contains($product->id) ? 'selected' : '' }}>
                            {{ $product->name }} ({{ $product->sku ?? 'No SKU' }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Select products to include in this collection.</small>
            </div>

            @if($productCollection->items->count() > 0)
            <div class="card card-outline card-info mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-sort mr-2"></i> Product Order & Featured Status</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th width="50">Order</th>
                                <th>Product</th>
                                <th width="100">Featured</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-products">
                            @foreach($productCollection->items as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td class="text-center">
                                        <i class="fas fa-grip-vertical text-muted" style="cursor: move;"></i>
                                    </td>
                                    <td>{{ $item->product->name ?? 'Unknown' }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs {{ $item->is_featured ? 'btn-warning' : 'btn-outline-secondary' }} toggle-featured" data-item-id="{{ $item->id }}">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <div class="form-group mt-4">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-save mr-1"></i> Save Changes
                </button>
                <a href="{{ route('admin.product-collections.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.layout-selector .layout-option {
    cursor: pointer;
    display: block;
}
.layout-selector .layout-card {
    border: 2px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    transition: all 0.2s;
    background: #fff;
}
.layout-selector .layout-card img {
    height: 60px;
    margin-bottom: 8px;
    opacity: 0.7;
}
.layout-selector .layout-card span {
    display: block;
    font-size: 12px;
    color: #666;
}
.layout-selector .layout-option:hover .layout-card {
    border-color: #007bff;
    background: #f8f9fa;
}
.layout-selector .layout-option:hover .layout-card img {
    opacity: 1;
}
.layout-selector .layout-option.selected .layout-card {
    border-color: #28a745;
    background: #d4edda;
}
.layout-selector .layout-option.selected .layout-card img {
    opacity: 1;
}
.layout-selector .layout-option.selected .layout-card span {
    color: #155724;
    font-weight: bold;
}
</style>

@endsection

@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
$(function() {
    $('.layout-option input[type="radio"]').on('change', function() {
        $('.layout-option').removeClass('selected');
        $(this).closest('.layout-option').addClass('selected');
    });

    // Sortable for product order
    var sortableEl = document.getElementById('sortable-products');
    if (sortableEl) {
        new Sortable(sortableEl, {
            animation: 150,
            handle: '.fa-grip-vertical',
            onEnd: function() {
                var items = [];
                $('#sortable-products tr').each(function() {
                    items.push($(this).data('id'));
                });
                
                $.ajax({
                    url: '{{ route("admin.product-collections.updateOrder", $productCollection) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        items: items
                    }
                });
            }
        });
    }

    // Toggle featured
    $('.toggle-featured').on('click', function() {
        var btn = $(this);
        var itemId = btn.data('item-id');
        
        $.ajax({
            url: '/admin/product-collections/item/' + itemId + '/toggle-featured',
            method: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                if (response.is_featured) {
                    btn.removeClass('btn-outline-secondary').addClass('btn-warning');
                } else {
                    btn.removeClass('btn-warning').addClass('btn-outline-secondary');
                }
            }
        });
    });
});
</script>
@endsection
