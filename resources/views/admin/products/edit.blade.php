@extends('layouts.admin')

@section('styles')
    @parent
    <style>
        .select2-container { width: 100% !important; }
        #pricingTable input[type="number"], #pricingTable input[type="text"] { 
            border: none !important; 
            border-bottom: 1px solid #ccc !important; 
            border-radius: 0 !important; 
            background-color: transparent; 
        }
        #pricingTable input:focus { outline: none !important; }
        .nav-tabs .nav-link { padding: 0.5rem 1rem; }
        .nav-tabs .nav-link i { margin-right: 0.25rem; }
    </style>
@endsection

@section('content')

<form method="POST" action="{{ route('admin.products.update', [$product->id]) }}" enctype="multipart/form-data" id="product-form">
    @csrf
    @method('PUT')
    <input type="hidden" name="active_tab" id="active_tab" value="{{ session('product_active_tab', 'general') }}">
    
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="product-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab">
                        <i class="fas fa-info-circle"></i> General
                    </a>
                </li>
                <li class="nav-item" id="variations-tab-li">
                    <a class="nav-link" id="variations-tab" data-toggle="tab" href="#variations" role="tab">
                        <i class="fas fa-th-list"></i> Variations
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pricing-tab" data-toggle="tab" href="#pricing" role="tab">
                        <i class="fas fa-dollar-sign"></i> Pricing
                    </a>
                </li>
                <li class="nav-item" id="clients-tab-li">
                    <a class="nav-link" id="clients-tab" data-toggle="tab" href="#clients" role="tab">
                        <i class="fas fa-users"></i> Client Access
                    </a>
                </li>
                <li class="nav-item" id="categories-tab-li">
                    <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab">
                        <i class="fas fa-tags"></i> Categories & Tags
                    </a>
                </li>
                <li class="nav-item" id="accessories-tab-li">
                    <a class="nav-link" id="accessories-tab" data-toggle="tab" href="#accessories" role="tab">
                        <i class="fas fa-puzzle-piece"></i> Accessories
                    </a>
                </li>
                <li class="nav-item" id="bundle-tab-li" style="{{ $product->product_type !== 'set' ? 'display:none;' : '' }}">
                    <a class="nav-link" id="bundle-tab" data-toggle="tab" href="#bundle" role="tab">
                        <i class="fas fa-box-open"></i> Bundle
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="media-tab" data-toggle="tab" href="#media" role="tab">
                        <i class="fas fa-images"></i> Media
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="card-body">
            <div class="tab-content" id="product-tabs-content">
                
                {{-- ========== GENERAL TAB ========== --}}
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    {{-- Visibility Controls --}}
                    <div class="card card-outline card-secondary mb-3">
                        <div class="card-header py-2 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-eye mr-1"></i> Display Options</h6>
                            @if($product->is_fake)
                                <span class="badge badge-info"><i class="fas fa-info-circle mr-1"></i> Demo Data</span>
                            @endif
                        </div>
                        <div class="card-body py-2">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <div class="icheck-success">
                                        <input type="hidden" name="published" value="0">
                                        <input type="checkbox" name="published" id="published" value="1" {{ old('published', $product->published ?? 1) ? 'checked' : '' }}>
                                        <label for="published">Published</label>
                                    </div>
                                    <small class="text-muted">Visible in shop</small>
                                </div>
                                <div class="col-md-2" id="featured_group">
                                    <div class="icheck-warning">
                                        <input type="hidden" name="featured" value="0">
                                        <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $product->featured ?? 0) ? 'checked' : '' }}>
                                        <label for="featured">Featured</label>
                                    </div>
                                    <small class="text-muted">Show on homepage</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="icheck-info">
                                        <input type="hidden" name="show_original_price" value="0">
                                        <input type="checkbox" name="show_original_price" id="show_original_price" value="1" {{ old('show_original_price', $product->show_original_price ?? 1) ? 'checked' : '' }}>
                                        <label for="show_original_price">Show Original Price</label>
                                    </div>
                                    <small class="text-muted">Strikethrough full price</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="icheck-info">
                                        <input type="hidden" name="show_variations" value="0">
                                        <input type="checkbox" name="show_variations" id="show_variations" value="1" {{ old('show_variations', $product->show_variations ?? 1) ? 'checked' : '' }}>
                                        <label for="show_variations">Show Variations</label>
                                    </div>
                                    <small class="text-muted">Size/style options</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="icheck-info">
                                        <input type="hidden" name="show_sets" value="0">
                                        <input type="checkbox" name="show_sets" id="show_sets" value="1" {{ old('show_sets', $product->show_sets ?? 1) ? 'checked' : '' }}>
                                        <label for="show_sets">Show Sets</label>
                                    </div>
                                    <small class="text-muted">Bundle options</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="icheck-info">
                                        <input type="hidden" name="show_accessories" value="0">
                                        <input type="checkbox" name="show_accessories" id="show_accessories" value="1" {{ old('show_accessories', $product->show_accessories ?? 1) ? 'checked' : '' }}>
                                        <label for="show_accessories">Show Accessories</label>
                                    </div>
                                    <small class="text-muted">Add-on options</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Type & Layout Row --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label for="product_type">Product Type</label>
                                <select class="form-control" name="product_type" id="product_type">
                                    @foreach(\App\Models\Product::TYPE_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('product_type', $product->product_type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label for="layout">Layout</label>
                                <select class="form-control" name="layout" id="layout">
                                    @foreach(\App\Models\Product::LAYOUT_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('layout', $product->layout) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" id="accessory_type_group" style="{{ $product->product_type !== 'accessory' ? 'display:none;' : '' }}">
                            <div class="form-group mb-0">
                                <label for="accessory_type_id">Accessory Type</label>
                                <select class="form-control" name="accessory_type_id" id="accessory_type_id">
                                    <option value="">-- Select Type --</option>
                                    @foreach(\App\Models\AccessoryType::orderBy('name')->get() as $type)
                                        <option value="{{ $type->id }}" {{ old('accessory_type_id', $product->accessory_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label for="total_quantity_display">Total Quantity</label>
                                <input type="text" class="form-control" id="total_quantity_display" value="{{ old('quantity', $product->quantity ?? 0) }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Name --}}
                    <div class="form-group">
                        <label class="required" for="name">Product Name</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    
                    {{-- Content Display Options --}}
                    <div class="card card-outline card-info mb-3">
                        <div class="card-header py-2">
                            <h6 class="mb-0"><i class="fas fa-list-alt mr-1"></i> Content Display Options</h6>
                        </div>
                        <div class="card-body py-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="icheck-primary">
                                        <input type="hidden" name="show_description_tab" value="0">
                                        <input type="checkbox" name="show_description_tab" id="show_description_tab" value="1" {{ old('show_description_tab', $product->show_description_tab ?? 1) ? 'checked' : '' }}>
                                        <label for="show_description_tab">Show Description Tab</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="icheck-primary">
                                        <input type="hidden" name="show_additional_info_tab" value="0">
                                        <input type="checkbox" name="show_additional_info_tab" id="show_additional_info_tab" value="1" {{ old('show_additional_info_tab', $product->show_additional_info_tab ?? 1) ? 'checked' : '' }}>
                                        <label for="show_additional_info_tab">Show Additional Info Tab</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="icheck-primary">
                                        <input type="hidden" name="show_shipping_return_tab" value="0">
                                        <input type="checkbox" name="show_shipping_return_tab" id="show_shipping_return_tab" value="1" {{ old('show_shipping_return_tab', $product->show_shipping_return_tab ?? 1) ? 'checked' : '' }}>
                                        <label for="show_shipping_return_tab">Show Shipping & Return Tab</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="icheck-success">
                                        <input type="hidden" name="show_tabs" value="0">
                                        <input type="checkbox" name="show_tabs" id="show_tabs" value="1" {{ old('show_tabs', $product->show_tabs ?? 1) ? 'checked' : '' }}>
                                        <label for="show_tabs">Enable Tabs Section</label>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted d-block mt-2">Control which content tabs are displayed on the product page. "Enable Tabs Section" must be checked for any tabs to show.</small>
                        </div>
                    </div>
                    
                    {{-- Excerpt --}}
                    <div class="form-group">
                        <label for="excerpt">Excerpt (Short Description)</label>
                        <textarea class="form-control" name="excerpt" id="excerpt" rows="3">{{ old('excerpt', $product->excerpt) }}</textarea>
                        <small class="text-muted">Brief description for product listings and cards.</small>
                    </div>
                    
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="description">Description (Full Content)</label>
                        @if($product->is_fake)
                            <button type="button" class="btn btn-outline-info btn-sm float-right" id="generateDemoContent">
                                <i class="fas fa-magic mr-1"></i> Generate Demo Content
                            </button>
                        @endif
                        <textarea class="form-control ckeditor" name="description" id="description" rows="6">{{ old('description', $product->description) }}</textarea>
                    </div>
                    
                    {{-- Additional Info --}}
                    <div class="form-group">
                        <label for="additional_info">Additional Information</label>
                        <textarea class="form-control ckeditor" name="additional_info" id="additional_info" rows="6">{{ old('additional_info', $product->additional_info) }}</textarea>
                        <small class="text-muted">Additional product details, specifications, care instructions, etc.</small>
                    </div>
                    
                    {{-- Shipping & Return --}}
                    <div class="form-group">
                        <label for="shipping_return">Shipping & Return Policy</label>
                        <textarea class="form-control ckeditor" name="shipping_return" id="shipping_return" rows="6">{{ old('shipping_return', $product->shipping_return) }}</textarea>
                        <small class="text-muted">Shipping information and return policy for this product.</small>
                    </div>
                </div>
                
                {{-- ========== VARIATIONS TAB ========== --}}
                <div class="tab-pane fade" id="variations" role="tabpanel">
                    @include('admin.products.partials.tab_variations')
                </div>
                
                {{-- ========== PRICING TAB ========== --}}
                <div class="tab-pane fade" id="pricing" role="tabpanel">
                    @include('admin.products.partials.tab_pricing')
                </div>
                
                {{-- ========== CLIENT ACCESS TAB ========== --}}
                <div class="tab-pane fade" id="clients" role="tabpanel">
                    @include('admin.products.partials.tab_client_access', [
                        'product' => $product,
                        'clients' => $clients,
                        'prices' => $prices ?? $product->clientPrices
                    ])
                </div>
                
                {{-- ========== CATEGORIES & TAGS TAB ========== --}}
                <div class="tab-pane fade" id="categories" role="tabpanel">
                    @include('admin.products.partials.tab_categories_tags')
                </div>
                
                {{-- ========== ACCESSORIES TAB ========== --}}
                <div class="tab-pane fade" id="accessories" role="tabpanel">
                    @include('admin.products.partials.accessories')
                </div>
                
                {{-- ========== BUNDLE TAB ========== --}}
                <div class="tab-pane fade" id="bundle" role="tabpanel">
                    @include('admin.products.partials.bundle_items')
                </div>
                
                {{-- ========== MEDIA TAB ========== --}}
                <div class="tab-pane fade" id="media" role="tabpanel">
                    @include('admin.products.partials.tab_media')
                </div>
                
            </div>
        </div>
        
        <div class="card-footer">
            <input type="hidden" name="redirect_back" id="redirect_back" value="1">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-save mr-1"></i> Save
            </button>
            <button class="btn btn-success" type="submit" onclick="document.getElementById('redirect_back').value='0'">
                <i class="fas fa-save mr-1"></i> Save & Close
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </div>
</form>

@endsection

@section('scripts')
<script>
    // Data for JS
    window.clientsData = @json($clients);
    window.clientPrices = @json($product->clientPrices);
    window.categories = @json($categories);
    window.variations = @json($product->variations ?? []);

    // ========== DROPZONE CONFIG ==========
    Dropzone.options.photoDropzone = {
        url: '{{ route('admin.products.storeMedia') }}',
        maxFilesize: 2,
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        params: { size: 20, width: 4096, height: 4096 },
        success: function (file, response) {
            $('form').find('input[name="photo"]').remove();
            $('form').append('<input type="hidden" name="photo" value="' + response.name + '">');
            // Show thumbnail preview from uploaded file
            if (response.preview) {
                this.emit('thumbnail', file, response.preview);
            }
        },
        removedfile: function (file) {
            file.previewElement.remove();
            if (file.status !== 'error') {
                $('form').find('input[name="photo"]').remove();
                this.options.maxFiles = this.options.maxFiles + 1;
            }
        },
        init: function () {
            @if(isset($product) && $product->photo)
            var file = {!! json_encode($product->photo) !!};
            this.options.addedfile.call(this, file);
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url);
            file.previewElement.classList.add('dz-complete');
            $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">');
            this.options.maxFiles = this.options.maxFiles - 1;
            @endif
        },
        error: function (file, response) {
            var message = ($.type(response) === 'string') ? response : response.errors.file;
            file.previewElement.classList.add('dz-error');
            file.previewElement.querySelectorAll('[data-dz-errormessage]').forEach(function(node) {
                node.textContent = message;
            });
        }
    };

    var uploadedAdditionalPhotosMap = {};
    Dropzone.options.additionalPhotosDropzone = {
        url: '{{ route('admin.products.storeMedia') }}',
        maxFilesize: 2,
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
        addRemoveLinks: true,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        params: { size: 20, width: 4096, height: 4096 },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="additional_photos[]" value="' + response.name + '">');
            uploadedAdditionalPhotosMap[file.name] = response.name;
            // Show thumbnail preview from uploaded file
            if (response.preview) {
                this.emit('thumbnail', file, response.preview);
            }
        },
        removedfile: function (file) {
            file.previewElement.remove();
            var name = (typeof file.file_name !== 'undefined') ? file.file_name : uploadedAdditionalPhotosMap[file.name];
            $('form').find('input[name="additional_photos[]"][value="' + name + '"]').remove();
        },
        init: function () {
            @if(isset($product) && $product->additional_photos && $product->additional_photos->count() > 0)
            @foreach($product->additional_photos as $media)
            var file = { name: "{{ $media->file_name }}", file_name: "{{ $media->file_name }}", size: {{ $media->size }} };
            this.options.addedfile.call(this, file);
            this.options.thumbnail.call(this, file, "{{ $media->preview ?? $media->getUrl('preview') }}");
            file.previewElement.classList.add('dz-complete');
            $('form').append('<input type="hidden" name="additional_photos[]" value="{{ $media->file_name }}">');
            @endforeach
            @endif
        },
        error: function (file, response) {
            var message = ($.type(response) === 'string') ? response : response.errors.file;
            file.previewElement.classList.add('dz-error');
            file.previewElement.querySelectorAll('[data-dz-errormessage]').forEach(function(node) {
                node.textContent = message;
            });
        }
    };

    // ========== DOM READY ==========
    document.addEventListener('DOMContentLoaded', function() {
        
        // Categories and tags use native multi-select (no select2)
        
        // ========== PRODUCT TYPE TOGGLE ==========
        function toggleProductTypeSections() {
            var type = $('#product_type').val();
            
            // Accessory type field
            $('#accessory_type_group').toggle(type === 'accessory');
            
            // Bundle tab
            $('#bundle-tab-li').toggle(type === 'set');
            
            // Categories tab (hide for accessories)
            $('#categories-tab-li').toggle(type !== 'accessory');
            
            // Accessories tab (hide for accessories themselves)
            $('#accessories-tab-li').toggle(type !== 'accessory');
            
            // Featured checkbox (hide for accessories)
            $('#featured_group').toggle(type !== 'accessory');
            
            // Variations tab - show for ALL product types (colors, sizes, materials, etc.)
            // $('#variations-tab-li').toggle(type !== 'accessory'); // Removed - variations available for all types
        }
        
        $('#product_type').on('change', toggleProductTypeSections);
        toggleProductTypeSections();
        
        // ========== VARIATIONS MANAGEMENT ==========
        var variationIndex = {{ isset($product) && $product->variations ? $product->variations->count() : 0 }};
        
        $('#addVariationBtn').on('click', function() {
            var categoryOptions = `<option value="">-- Select --</option>@foreach(\App\Models\VariationCategory::where('published', true)->orderBy('sort_order')->get() as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option>@endforeach`;
            var newRow = `
                <tr class="variation-row" data-index="${variationIndex}">
                    <td class="text-center">
                        <input type="hidden" name="variations[${variationIndex}][active]" value="0">
                        <input type="checkbox" name="variations[${variationIndex}][active]" value="1" checked>
                    </td>
                    <td>
                        <select name="variations[${variationIndex}][variation_category_id]" class="form-control form-control-sm">
                            ${categoryOptions}
                        </select>
                    </td>
                    <td>
                        <input type="text" name="variations[${variationIndex}][name]" class="form-control form-control-sm" placeholder="e.g., Small 8&quot;" required>
                    </td>
                    <td>
                        <input type="text" name="variations[${variationIndex}][description]" class="form-control form-control-sm" placeholder="Optional description">
                    </td>
                    <td>
                        <input type="number" name="variations[${variationIndex}][quantity]" class="form-control form-control-sm" value="0" min="0">
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="variations[${variationIndex}][show_quantity]" value="0">
                        <input type="checkbox" name="variations[${variationIndex}][show_quantity]" value="1">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-variation-btn">&times;</button>
                    </td>
                </tr>
            `;
            $('#variationsBody').append(newRow);
            variationIndex++;
        });
        
        $(document).on('click', '.remove-variation-btn', function() {
            $(this).closest('tr').remove();
        });
        
        // ========== QUICK ADD EXISTING VARIATION ==========
        $('#quickAddCategory').on('change', function() {
            var categoryId = $(this).val();
            var $variationSelect = $('#quickAddVariation');
            var $addBtn = $('#quickAddBtn');
            var $addAllBtn = $('#quickAddAllBtn');
            
            if (!categoryId) {
                $variationSelect.html('<option value="">-- Select a category first --</option>').prop('disabled', true);
                $addBtn.prop('disabled', true);
                $addAllBtn.prop('disabled', true);
                return;
            }
            
            var variations = window.existingVariationsByCategory[categoryId] || [];
            var options = '<option value="">-- Select Variation --</option>';
            
            variations.forEach(function(v) {
                var desc = v.description ? ' - ' + v.description : '';
                options += '<option value="' + v.name + '" data-description="' + (v.description || '') + '">' + v.name + desc + '</option>';
            });
            
            if (variations.length === 0) {
                options = '<option value="">-- No existing variations --</option>';
            }
            
            $variationSelect.html(options).prop('disabled', variations.length === 0);
            $addBtn.prop('disabled', true);
            $addAllBtn.prop('disabled', variations.length === 0);
        });
        
        $('#quickAddVariation').on('change', function() {
            $('#quickAddBtn').prop('disabled', !$(this).val());
        });
        
        $('#quickAddBtn').on('click', function() {
            var categoryId = $('#quickAddCategory').val();
            var categoryName = $('#quickAddCategory option:selected').text();
            var variationName = $('#quickAddVariation').val();
            var description = $('#quickAddVariation option:selected').data('description') || '';
            
            if (!categoryId || !variationName) return;
            
            var categoryOptions = `<option value="">-- Select --</option>@foreach(\App\Models\VariationCategory::where('published', true)->orderBy('sort_order')->get() as $cat)<option value="{{ $cat->id }}"${categoryId == '{{ $cat->id }}' ? ' selected' : ''}>{{ $cat->name }}</option>@endforeach`;
            // Build options with correct selection
            categoryOptions = '<option value="">-- Select --</option>';
            @foreach(\App\Models\VariationCategory::where('published', true)->orderBy('sort_order')->get() as $cat)
            if (categoryId == '{{ $cat->id }}') {
                categoryOptions += '<option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>';
            } else {
                categoryOptions += '<option value="{{ $cat->id }}">{{ $cat->name }}</option>';
            }
            @endforeach
            
            var newRow = `
                <tr class="variation-row" data-index="${variationIndex}">
                    <td class="text-center">
                        <input type="hidden" name="variations[${variationIndex}][active]" value="0">
                        <input type="checkbox" name="variations[${variationIndex}][active]" value="1" checked>
                    </td>
                    <td>
                        <select name="variations[${variationIndex}][variation_category_id]" class="form-control form-control-sm">
                            ${categoryOptions}
                        </select>
                    </td>
                    <td>
                        <input type="text" name="variations[${variationIndex}][name]" class="form-control form-control-sm" value="${variationName}" required>
                    </td>
                    <td>
                        <input type="text" name="variations[${variationIndex}][description]" class="form-control form-control-sm" value="${description}">
                    </td>
                    <td>
                        <input type="number" name="variations[${variationIndex}][quantity]" class="form-control form-control-sm" value="0" min="0">
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="variations[${variationIndex}][show_quantity]" value="0">
                        <input type="checkbox" name="variations[${variationIndex}][show_quantity]" value="1">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-variation-btn">&times;</button>
                    </td>
                </tr>
            `;
            $('#variationsBody').append(newRow);
            // Set the category dropdown value after appending
            $('#variationsBody tr:last select[name$="[variation_category_id]"]').val(categoryId);
            variationIndex++;
            
            // Reset quick add
            $('#quickAddVariation').val('');
            $('#quickAddBtn').prop('disabled', true);
        });
        
        // ========== QUICK ADD ALL FROM CATEGORY ==========
        $('#quickAddAllBtn').on('click', function() {
            var categoryId = $('#quickAddCategory').val();
            if (!categoryId) return;
            
            var variations = window.existingVariationsByCategory[categoryId] || [];
            if (variations.length === 0) return;
            
            var addedCount = 0;
            variations.forEach(function(v) {
                // Build category options
                var categoryOptions = '<option value="">-- Select --</option>';
                @foreach(\App\Models\VariationCategory::where('published', true)->orderBy('sort_order')->get() as $cat)
                if (categoryId == '{{ $cat->id }}') {
                    categoryOptions += '<option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>';
                } else {
                    categoryOptions += '<option value="{{ $cat->id }}">{{ $cat->name }}</option>';
                }
                @endforeach
                
                var newRow = `
                    <tr class="variation-row" data-index="${variationIndex}">
                        <td class="text-center">
                            <input type="hidden" name="variations[${variationIndex}][active]" value="0">
                            <input type="checkbox" name="variations[${variationIndex}][active]" value="1" checked>
                        </td>
                        <td>
                            <select name="variations[${variationIndex}][variation_category_id]" class="form-control form-control-sm">
                                ${categoryOptions}
                            </select>
                        </td>
                        <td>
                            <input type="text" name="variations[${variationIndex}][name]" class="form-control form-control-sm" value="${v.name}" required>
                        </td>
                        <td>
                            <input type="text" name="variations[${variationIndex}][description]" class="form-control form-control-sm" value="${v.description || ''}">
                        </td>
                        <td>
                            <input type="number" name="variations[${variationIndex}][quantity]" class="form-control form-control-sm" value="0" min="0">
                        </td>
                        <td class="text-center">
                            <input type="hidden" name="variations[${variationIndex}][show_quantity]" value="0">
                            <input type="checkbox" name="variations[${variationIndex}][show_quantity]" value="1">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-variation-btn">&times;</button>
                        </td>
                    </tr>
                `;
                $('#variationsBody').append(newRow);
                $('#variationsBody tr:last select[name$="[variation_category_id]"]').val(categoryId);
                variationIndex++;
                addedCount++;
            });
            
            // Show confirmation
            if (addedCount > 0) {
                toastr.success('Added ' + addedCount + ' variation(s) from category');
            }
        });
        
        // ========== PRICING MANAGEMENT ==========
        function updateTotalQuantity() {
            var total = 0;
            $('.pricing-qty').each(function() {
                total += parseInt($(this).val()) || 0;
            });
            $('#totalQuantity').val(total);
            $('#total_quantity_display').val(total); // Sync to General tab
        }
        
        $(document).on('input', '.pricing-qty', updateTotalQuantity);
        updateTotalQuantity();
        
        var pricingIndex = $('#pricingBody tr').length;
        
        $('#addPricingRowBtn').on('click', function() {
            var newRow = `
                <tr class="pricing-row" data-index="${pricingIndex}">
                    <td>
                        <input type="hidden" name="pricing[${pricingIndex}][variation_id]" value="">
                        <select name="pricing[${pricingIndex}][variation_select]" class="form-control form-control-sm variation-select">
                            <option value="">(Base Product)</option>
                        </select>
                    </td>
                    <td><input type="text" name="pricing[${pricingIndex}][sku]" class="form-control form-control-sm" placeholder="SKU"></td>
                    <td><input type="text" name="pricing[${pricingIndex}][upc_code]" class="form-control form-control-sm" placeholder="UPC"></td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="number" step="0.01" name="pricing[${pricingIndex}][base_price]" class="form-control">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="number" step="0.01" name="pricing[${pricingIndex}][full_price]" class="form-control">
                        </div>
                    </td>
                    <td><input type="number" name="pricing[${pricingIndex}][quantity]" class="form-control form-control-sm pricing-qty" value="0" min="0"></td>
                    <td><input type="text" name="pricing[${pricingIndex}][qb_1]" class="form-control form-control-sm" placeholder="QB1"></td>
                    <td><input type="text" name="pricing[${pricingIndex}][qb_2]" class="form-control form-control-sm" placeholder="QB2"></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-pricing-btn">&times;</button>
                    </td>
                </tr>
            `;
            $('#pricingBody').append(newRow);
            pricingIndex++;
            updateTotalQuantity();
        });
        
        $(document).on('click', '.remove-pricing-btn', function() {
            $(this).closest('tr').remove();
            updateTotalQuantity();
        });
        
        // ========== PRICE TIERS MANAGEMENT ==========
        var priceTierIndex = {{ isset($product) && $product->priceTiers ? $product->priceTiers->count() : 0 }};
        
        $('#addPriceTierBtn').on('click', function() {
            var newRow = `
                <tr class="price-tier-row" data-index="${priceTierIndex}">
                    <td><input type="text" name="price_tiers[${priceTierIndex}][tier_group]" class="form-control form-control-sm" placeholder="Group name"></td>
                    <td><input type="number" name="price_tiers[${priceTierIndex}][min_quantity]" class="form-control form-control-sm" min="1"></td>
                    <td><input type="number" name="price_tiers[${priceTierIndex}][max_quantity]" class="form-control form-control-sm" placeholder="No limit"></td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="number" step="0.01" name="price_tiers[${priceTierIndex}][price]" class="form-control">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <input type="number" step="0.01" name="price_tiers[${priceTierIndex}][discount_percent]" class="form-control" placeholder="0">
                            <div class="input-group-append"><span class="input-group-text">%</span></div>
                        </div>
                    </td>
                    <td><input type="text" name="price_tiers[${priceTierIndex}][label]" class="form-control form-control-sm" placeholder="Label"></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-tier-btn">&times;</button>
                    </td>
                </tr>
            `;
            $('#priceTiersBody').append(newRow);
            priceTierIndex++;
        });
        
        $(document).on('click', '.remove-tier-btn', function() {
            $(this).closest('tr').remove();
        });
        
        // ========== QUICK ADD PRICE TIER ==========
        function checkQuickAddTierEnabled() {
            var hasSelection = $('#quickAddTier').val() !== '';
            var hasPrice = $('#quickAddTierPrice').val() !== '';
            $('#quickAddTierBtn').prop('disabled', !(hasSelection && hasPrice));
        }
        
        $('#quickAddTier').on('change', function() {
            // Auto-fill tier group from selected option
            var $selected = $(this).find('option:selected');
            var group = $selected.data('group');
            if (group) {
                $('#quickAddTierGroup').val(group);
            }
            checkQuickAddTierEnabled();
        });
        
        $('#quickAddTierPrice').on('input', checkQuickAddTierEnabled);
        $('#quickAddTierGroup').on('change', checkQuickAddTierEnabled);
        
        $('#quickAddTierBtn').on('click', function() {
            var $selected = $('#quickAddTier option:selected');
            var minQty = $selected.data('min');
            var maxQty = $selected.data('max') || '';
            var label = $selected.data('label') || '';
            var tierGroup = $('#quickAddTierGroup').val() || $selected.data('group') || '';
            var price = $('#quickAddTierPrice').val();
            
            if (!minQty || !price) return;
            
            var newRow = `
                <tr class="price-tier-row" data-index="${priceTierIndex}">
                    <td><input type="text" name="price_tiers[${priceTierIndex}][tier_group]" class="form-control form-control-sm" value="${tierGroup}" placeholder="Group name"></td>
                    <td><input type="number" name="price_tiers[${priceTierIndex}][min_quantity]" class="form-control form-control-sm" min="1" value="${minQty}"></td>
                    <td><input type="number" name="price_tiers[${priceTierIndex}][max_quantity]" class="form-control form-control-sm" placeholder="No limit" value="${maxQty}"></td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="number" step="0.01" name="price_tiers[${priceTierIndex}][price]" class="form-control" value="${price}">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <input type="number" step="0.01" name="price_tiers[${priceTierIndex}][discount_percent]" class="form-control" placeholder="0">
                            <div class="input-group-append"><span class="input-group-text">%</span></div>
                        </div>
                    </td>
                    <td><input type="text" name="price_tiers[${priceTierIndex}][label]" class="form-control form-control-sm" value="${label}" placeholder="Label"></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-tier-btn">&times;</button>
                    </td>
                </tr>
            `;
            $('#priceTiersBody').append(newRow);
            priceTierIndex++;
            
            // Reset quick add
            $('#quickAddTier').val('');
            $('#quickAddTierPrice').val('');
            $('#quickAddTierBtn').prop('disabled', true);
        });
        
        // ========== CLIENT ACCESS MANAGEMENT ==========
        
        // Initialize Select2 for client select
        $('#clientSelect').select2({
            placeholder: 'Select clients...',
            allowClear: true,
            width: '100%'
        });
        
        // Toggle client select visibility based on availability mode
        function toggleAvailabilityMode() {
            var mode = $('input[name="availability_mode"]:checked').val();
            if (mode === 'all') {
                $('#clientSelectContainer').hide();
                // Clear client selection when switching to "all"
                $('#clientSelect').val([]).trigger('change');
                // Show all clients in price overrides when "all" mode
                updatePriceOverrides(true);
            } else {
                $('#clientSelectContainer').show();
                // Filter price overrides to selected clients only
                updatePriceOverrides(false);
            }
        }
        
        // Update price override rows based on mode and selection
        function updatePriceOverrides(showAll) {
            var selectedIds = $('#clientSelect').val() || [];
            
            if (showAll) {
                // Show all client rows for price overrides
                $('.client-price-row').show();
                $('#noClientPricesMsg').hide();
            } else {
                // Show only selected clients
                $('.client-price-row').each(function() {
                    var clientId = String($(this).data('client-id'));
                    if (selectedIds.includes(clientId)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                
                // Toggle empty message
                if (selectedIds.length > 0) {
                    $('#noClientPricesMsg').hide();
                } else {
                    $('#noClientPricesMsg').show();
                    $('#noPricesText').text('Select clients above to set custom pricing.');
                }
            }
        }
        
        // Bind events
        $('input[name="availability_mode"]').on('change', toggleAvailabilityMode);
        $('#clientSelect').on('change', function() {
            updatePriceOverrides($('input[name="availability_mode"]:checked').val() === 'all');
        });
        
        // Initialize on page load
        toggleAvailabilityMode();
        
        // ========== ADD NEW CATEGORY ==========
        $('#addCategory').on('click', function() {
            var name = prompt("Enter new category name:");
            if (!name) return;
            
            $.ajax({
                url: '/admin/product-categories/store-ajax',
                type: 'POST',
                data: { name: name, _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    var newOption = new Option(response.name, response.id, true, true);
                    $('#categories').append(newOption).trigger('change');
                },
                error: function(xhr, status, error) {
                    alert("Error adding category: " + error);
                }
            });
        });
        
        // ========== ADD NEW TAG ==========
        $('#addTag').on('click', function() {
            var name = prompt("Enter new tag name:");
            if (!name) return;
            
            $.ajax({
                url: '/admin/product-tags/store-ajax',
                type: 'POST',
                data: { name: name, _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    var newOption = new Option(response.name, response.id, true, true);
                    $('#tags').append(newOption).trigger('change');
                },
                error: function(xhr, status, error) {
                    alert("Error adding tag: " + error);
                }
            });
        });
        
        // ========== ADD NEW CLIENT ==========
        $('#addClient').on('click', function() {
            var name = prompt("Enter new client name:");
            if (!name) return;
            
            $.ajax({
                url: '/admin/clients/store-ajax',
                type: 'POST',
                data: { name: name, _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    var newOption = new Option(response.name, response.id, true, true);
                    $('#clientSelect').append(newOption).trigger('change');
                },
                error: function(xhr, status, error) {
                    alert("Error adding client: " + error);
                }
            });
        });
        
        // ========== GENERATE DEMO CONTENT ==========
        function generateDemoContent() {
            var productName = $('#name').val() || 'Indoor Plant';
            
            // Product Description - Pacific Plant Growers content
            var description = '<div class="row  g-3 m-b30 align-items-center">' +
                '<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 ">' +
                    '<div class="description style-1">' +
                        '<h2 class="sub-title">The Quality &amp; Style</h2>' +
                        '<h2 class="title">Premium Quality Indoor Plants</h2>' +
                        '<p class="font-wight-500">Pacific Plant Growers has been supplying premium indoor plants to grocery stores and flower shops for over 20 years. Our ' + productName + ' is carefully grown and nurtured to ensure it arrives in peak condition, ready to delight your customers with its vibrant foliage and healthy appearance.</p>' +
                    '</div>' +
                '</div>' +
                '<div class="col-xl-4 col-lg-3 col-md-6 col-sm-6 ">' +
                    '<div class="related-img dz-media">' +
                        '<img src="{{ asset("site/images/feature/product-feature-4/1.png") }}" alt="/">' +
                    '</div>' +
                '</div>' +
                '<div class="col-xl-4 col-lg-3 col-md-6 col-sm-6">' +
                    '<div class="related-img dz-media">' +
                        '<img src="{{ asset("site/images/feature/product-feature-4/2.png") }}" alt="/">' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="row g-lg-4 g-3">' +
                '<div class="col-xl-3 col-md-6 col-sm-12 ">' +
                    '<div class="icon-bx-wraper style-6 m-b15">' +
                        '<div class="icon-bx">' +
                            '<i class="flaticon flaticon-chat-8"></i>' +
                        '</div>' +
                        '<div class="icon-content">' +
                            '<h3 class="dz-title">Eco Friendly Product</h3>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-xl-3 col-md-6 col-sm-12 ">' +
                    '<div class="icon-bx-wraper style-6 m-b15">' +
                        '<div class="icon-bx">' +
                            '<i class="flaticon flaticon-paper"></i>' +
                        '</div>' +
                        '<div class="icon-content">' +
                            '<h3 class="dz-title">Easy To Clean And Maintain</h3>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-xl-3 col-md-6 col-sm-12">' +
                    '<div class="icon-bx-wraper style-6 m-b15">' +
                        '<div class="icon-bx">' +
                            '<i class="flaticon flaticon-cardboard-box"></i>' +
                        '</div>' +
                        '<div class="icon-content">' +
                            '<h3 class="dz-title">Premium Finish Quality</h3>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-xl-3 col-md-6 col-sm-12">' +
                    '<div class="icon-bx-wraper style-6 m-b15 border-0">' +
                        '<div class="icon-bx">' +
                            '<i class="flaticon flaticon-delivery-status"></i>' +
                        '</div>' +
                        '<div class="icon-content">' +
                            '<h3 class="dz-title">Moisture Proof Product</h3>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<img src="{{ asset("site/images/background/bg4.jpg") }}" alt="">';
            
            // Additional Info content - Pacific Plant Growers
            var additionalInfo = '<div class="detail-bx text-center">' +
                '<h5 class="title">Additional Information</h5>' +
                '<p class="para-text">' +
                    'Pacific Plant Growers has been supplying premium indoor plants to retailers for over 20 years. Our ' + productName + ' represents our commitment to quality, freshness, and customer satisfaction. Each plant is carefully grown and nurtured in our greenhouses to ensure it arrives in peak condition, ready to delight your customers. We specialize in providing healthy, vibrant plants that are perfect for grocery stores, flower shops, and garden centers throughout the region.' +
                '</p>' +
                '<ul class="feature-detail justify-content-center">' +
                    '<li>' +
                        '<i class="icon feather icon-check"></i>' +
                        '<h5>Technical Details</h5>' +
                    '</li>' +
                    '<li>' +
                        '<i class="icon feather icon-check"></i>' +
                        '<h5>Additional Information</h5>' +
                    '</li>' +
                    '<li>' +
                        '<i class="icon feather icon-check"></i>' +
                        '<h5> Feedback </h5>' +
                    '</li>' +
                '</ul>' +
            '</div>' +
            '<div class="table-responsive">' +
                '<table class="table check-tbl">' +
                    '<tbody>' +
                        '<tr>' +
                            '<td class="product-item-name">Product ID</td>' +
                            '<td class="product-item-name">PPG-' + productName.replace(/\s+/g, '-').toUpperCase() + '</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td class="product-item-name">Grower</td>' +
                            '<td class="product-item-name">Pacific Plant Growers</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td class="product-item-name">Origin</td>' +
                            '<td class="product-item-name">United States</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td class="product-item-name">Growing Method</td>' +
                            '<td class="product-item-name">Greenhouse Grown</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td class="product-item-name">Pot Size</td>' +
                            '<td class="product-item-name">4 inch / 6 inch / 8 inch</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td class="product-item-name">Care Level</td>' +
                            '<td class="product-item-name">Easy to Moderate</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td class="product-item-name">Light Requirements</td>' +
                            '<td class="product-item-name">Bright Indirect Light</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td class="product-item-name">Category</td>' +
                            '<td class="product-item-name">Indoor Plant</td>' +
                        '</tr>' +
                    '</tbody>' +
                '</table>' +
            '</div>';
            
            // Shipping & Return content - Pacific Plant Growers
            var shippingReturn = '<div class="detail-bx text-center">' +
                '<h5 class="title">Shipping Policy</h5>' +
                '<p class="para-text">' +
                    'We deliver fresh, healthy plants directly to your store location. All plants are carefully packaged to ensure they arrive in excellent condition. Our delivery schedules are coordinated with your receiving department for maximum convenience. We understand the importance of timely delivery for perishable products, and our logistics team works diligently to ensure your ' + productName + ' arrives ready for immediate display and sale to your customers.' +
                '</p>' +
                '<h5 class="title">Returns Policy</h5>' +
                '<p class="para-text">' +
                    'We stand behind the quality of our plants. If you receive a plant that does not meet our quality standards, please contact us within 48 hours of delivery. We will work with you to resolve any issues promptly, whether through replacement or credit. Your satisfaction is our priority, and we are committed to ensuring every ' + productName + ' you receive meets the high standards Pacific Plant Growers is known for throughout the industry.' +
                '</p>' +
                '<ul class="feature-detail justify-content-center">' +
                    '<li>' +
                        '<i class="icon feather icon-check"></i>' +
                        '<h5>7 Days Replacement only</h5>' +
                    '</li>' +
                    '<li>' +
                        '<i class="icon feather icon-check"></i>' +
                        '<h5>7 Days Refund for accidental orders only</h5>' +
                    '</li>' +
                    '<li>' +
                        '<i class="icon feather icon-check"></i>' +
                        '<h5>3 days refund only</h5>' +
                    '</li>' +
                '</ul>' +
            '</div>';
            
            
            // Generate plain text excerpts for plants
            var excerpts = [
                'Premium quality ' + productName + ' perfect for retail display. Healthy, vibrant plants that your customers will love.',
                'Fresh, beautiful ' + productName + ' from Pacific Plant Growers. Easy care and excellent for grocery stores and flower shops.',
                'Wholesale ' + productName + ' with consistent quality and reliable delivery. Perfect addition to your plant department.',
                'Attractive ' + productName + ' ideal for retail sales. Low maintenance and customer-friendly care requirements.'
            ];
            
            var randomExcerpt = excerpts[Math.floor(Math.random() * excerpts.length)];
            
            // Set the excerpt
            $('#excerpt').val(randomExcerpt);
            
            // Set content for Froala editors using global instances
            if (window.descriptionEditor) {
                window.descriptionEditor.html.set(description);
            } else {
                $('#description').val(description);
            }
            
            if (window.additionalInfoEditor) {
                window.additionalInfoEditor.html.set(additionalInfo);
            } else {
                $('#additional_info').val(additionalInfo);
            }
            
            if (window.shippingReturnEditor) {
                window.shippingReturnEditor.html.set(shippingReturn);
            } else {
                $('#shipping_return').val(shippingReturn);
            }
            
            // Show success feedback
            $('#generateDemoContent').removeClass('btn-outline-info').addClass('btn-success');
            $('#generateDemoContent').html('<i class="fas fa-check mr-1"></i> Content Generated!');
            setTimeout(function() {
                $('#generateDemoContent').removeClass('btn-success').addClass('btn-outline-info');
                $('#generateDemoContent').html('<i class="fas fa-magic mr-1"></i> Generate Demo Content');
            }, 2000);
        }
        
        // Bind click handler
        $('#generateDemoContent').on('click', generateDemoContent);
        
        // Auto-generate if demo product has empty content
        @if($product->is_fake)
        if (!$('#excerpt').val().trim() && !$('#description').val().trim()) {
            // Wait for CKEditor to initialize, then generate
            setTimeout(generateDemoContent, 500);
        }
        @endif
        
    });
    
    // ========== BUNDLE ITEMS (if needed) ==========
    @if($product->product_type === 'set')
    var groupIndex = {{ $product->bundleItems ? $product->bundleItems->groupBy('group_name')->count() : 1 }};
    var productOptions = '@foreach(\App\Models\Product::where("id", "!=", $product->id)->orderBy("name")->get() as $p)<option value="{{ $p->id }}">{{ addslashes($p->name) }} (\${{ number_format($p->base_price ?? 0, 2) }})</option>@endforeach';
    @endif
    
    // ========== TAB PERSISTENCE ==========
    // Restore active tab from session
    var savedTab = '{{ session('product_active_tab', 'general') }}';
    if (savedTab && savedTab !== 'general') {
        $('#product-tabs a[href="#' + savedTab + '"]').tab('show');
    }
    
    // Track tab changes
    $('#product-tabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var tabId = $(e.target).attr('href').replace('#', '');
        $('#active_tab').val(tabId);
    });
    
    // ========== FROALA EDITOR INITIALIZATION ==========
    $(document).ready(function() {
        // Froala Editor configuration
        const froalaConfig = {
            toolbarButtons: {
                'moreText': {
                    'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']
                },
                'moreParagraph': {
                    'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
                },
                'moreRich': {
                    'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR']
                },
                'moreMisc': {
                    'buttons': ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help'],
                    'align': 'right',
                    'buttonsVisible': 2
                }
            },
            pluginsEnabled: ['align', 'charCounter', 'codeBeautifier', 'codeView', 'colors', 'draggable', 'emoticons', 'entities', 'fontFamily', 'fontSize', 'fullscreen', 'image', 'imageManager', 'inlineStyle', 'lineBreaker', 'lineHeight', 'link', 'lists', 'paragraphFormat', 'paragraphStyle', 'quickInsert', 'quote', 'save', 'table', 'url', 'video', 'wordPaste'],
            heightMin: 300,
            attribution: false
        };
        
        // Store editor instances globally
        window.descriptionEditor = null;
        window.additionalInfoEditor = null;
        window.shippingReturnEditor = null;
        
        // Initialize Froala on all three textareas
        if ($('#description').length) {
            window.descriptionEditor = new FroalaEditor('#description', froalaConfig);
        }
        
        if ($('#additional_info').length) {
            window.additionalInfoEditor = new FroalaEditor('#additional_info', froalaConfig);
        }
        
        if ($('#shipping_return').length) {
            window.shippingReturnEditor = new FroalaEditor('#shipping_return', froalaConfig);
        }
    });
</script>
@endsection
