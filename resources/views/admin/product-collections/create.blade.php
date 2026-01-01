@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-plus mr-2"></i> Create Product Collection</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.product-collections.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="required" for="name">Collection Name</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="slug">Slug (URL)</label>
                        <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="auto-generated if empty">
                        @if($errors->has('slug'))
                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" rows="2">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label class="required">Layout Style</label>
                <div class="row layout-selector">
                    @foreach($layouts as $key => $label)
                        <div class="col-md-3 col-sm-4 col-6 mb-3">
                            <label class="layout-option {{ old('layout_type', 'grid') == $key ? 'selected' : '' }}">
                                <input type="radio" name="layout_type" value="{{ $key }}" {{ old('layout_type', 'grid') == $key ? 'checked' : '' }} class="d-none">
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
                                <option value="{{ $i }}" {{ old('columns', 4) == $i ? 'selected' : '' }}>{{ $i }} columns</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <input class="form-control" type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="background_color">Background Color</label>
                        <input class="form-control" type="color" name="background_color" id="background_color" value="{{ old('background_color', '#ffffff') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="text_color">Text Color</label>
                        <input class="form-control" type="color" name="text_color" id="text_color" value="{{ old('text_color', '#333333') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="hidden" name="published" value="0">
                            <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published') ? 'checked' : '' }}>
                            <label class="form-check-label" for="published">Published</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check">
                            <input type="hidden" name="show_on_homepage" value="0">
                            <input class="form-check-input" type="checkbox" name="show_on_homepage" id="show_on_homepage" value="1" {{ old('show_on_homepage') ? 'checked' : '' }}>
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
                        <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku ?? 'No SKU' }})</option>
                    @endforeach
                </select>
                <small class="text-muted">Select products to include in this collection. Order can be adjusted after creation.</small>
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-save mr-1"></i> Create Collection
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
<script>
$(function() {
    $('.layout-option input[type="radio"]').on('change', function() {
        $('.layout-option').removeClass('selected');
        $(this).closest('.layout-option').addClass('selected');
    });

    $('#name').on('blur', function() {
        if ($('#slug').val() === '') {
            var slug = $(this).val().toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
            $('#slug').val(slug);
        }
    });
});
</script>
@endsection
