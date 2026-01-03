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
                    <td><input type="number" name="price_tiers[${priceTierIndex}][min_quantity]" class="form-control form-control-sm" min="1"></td>
                    <td><input type="number" name="price_tiers[${priceTierIndex}][max_quantity]" class="form-control form-control-sm" placeholder="No limit"></td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="number" step="0.01" name="price_tiers[${priceTierIndex}][price]" class="form-control">
                        </div>
                    </td>
                    <td><input type="text" name="price_tiers[${priceTierIndex}][label]" class="form-control form-control-sm" placeholder="e.g., Bulk"></td>
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
            var productName = $('#name').val() || 'This Product';
            
            // Generate styled HTML description with theme classes
            var descriptions = [
                '<h3 class="dz-title mb-3">Product Overview</h3>' +
                '<p class="mb-4">Discover the exceptional quality of our <strong>' + productName + '</strong>. Crafted with care and attention to detail, this product is designed to exceed your expectations.</p>' +
                '<h4 class="dz-title mb-3">Key Features</h4>' +
                '<ul class="list-check primary mb-4">' +
                '<li><strong>Premium Quality:</strong> Made from the finest materials for lasting durability</li>' +
                '<li><strong>Versatile Design:</strong> Perfect for any occasion or setting</li>' +
                '<li><strong>Easy Care:</strong> Simple maintenance keeps it looking beautiful</li>' +
                '<li><strong>Gift Ready:</strong> Makes an excellent gift for any special occasion</li>' +
                '</ul>' +
                '<h4 class="dz-title mb-3">Perfect For</h4>' +
                '<p class="mb-4">Whether you are looking for a stunning centerpiece, a thoughtful gift, or a beautiful addition to your collection, the <em>' + productName + '</em> delivers on all fronts. Its timeless design complements both modern and traditional settings.</p>' +
                '<div class="alert alert-light border-start border-primary border-4 ps-3">' +
                '<strong>Pro Tip:</strong> Pair with our matching accessories for a complete, coordinated look!' +
                '</div>',
                
                '<h3 class="dz-title mb-3">About ' + productName + '</h3>' +
                '<p class="mb-4">Elevate your space with the stunning <strong>' + productName + '</strong>. This carefully curated piece combines functionality with aesthetic appeal.</p>' +
                '<h4 class="dz-title mb-3">What Makes It Special</h4>' +
                '<ul class="list-check primary mb-4">' +
                '<li><strong>Handcrafted Excellence:</strong> Each piece is made with meticulous attention to detail</li>' +
                '<li><strong>Sustainable Materials:</strong> Eco-friendly options that do not compromise on style</li>' +
                '<li><strong>Timeless Appeal:</strong> A classic design that never goes out of style</li>' +
                '<li><strong>Customer Favorite:</strong> Highly rated by our satisfied customers</li>' +
                '</ul>' +
                '<h4 class="dz-title mb-3">Care Instructions</h4>' +
                '<p class="mb-3">To maintain the beauty of your <em>' + productName + '</em>, we recommend gentle cleaning with a soft cloth. Avoid direct sunlight for prolonged periods to preserve colors.</p>' +
                '<p class="text-muted fst-italic"><strong>Dimensions and specifications may vary slightly as each piece is unique.</strong></p>',
                
                '<h3 class="dz-title mb-3">Introducing ' + productName + '</h3>' +
                '<p class="mb-4">Transform any space with the elegant <strong>' + productName + '</strong>. This exceptional piece showcases superior craftsmanship and thoughtful design.</p>' +
                '<h4 class="dz-title mb-3">Highlights</h4>' +
                '<ul class="list-check primary mb-4">' +
                '<li><strong>Quality Construction:</strong> Built to last with premium materials</li>' +
                '<li><strong>Beautiful Finish:</strong> Eye-catching details that stand out</li>' +
                '<li><strong>Multiple Uses:</strong> Versatile enough for home, office, or gifts</li>' +
                '<li><strong>Value:</strong> Exceptional quality at a competitive price</li>' +
                '</ul>' +
                '<h4 class="dz-title mb-3">Why Choose Us?</h4>' +
                '<p class="mb-3">We take pride in offering products that combine beauty, quality, and value. The <em>' + productName + '</em> is no exception, representing our commitment to excellence in every detail.</p>' +
                '<p class="text-primary fw-semibold"><em>Order today and experience the difference quality makes!</em></p>'
            ];
            
            var randomDescription = descriptions[Math.floor(Math.random() * descriptions.length)];
            
            // Generate plain text excerpt
            var excerpts = [
                'Discover the exceptional quality of our ' + productName + '. Crafted with care and attention to detail, perfect for any occasion.',
                'Elevate your space with the stunning ' + productName + '. A beautiful combination of functionality and aesthetic appeal.',
                'Transform any setting with the elegant ' + productName + '. Superior craftsmanship meets thoughtful design.',
                'Experience premium quality with our ' + productName + '. Made from the finest materials for lasting beauty and durability.'
            ];
            
            var randomExcerpt = excerpts[Math.floor(Math.random() * excerpts.length)];
            
            // Set the excerpt
            $('#excerpt').val(randomExcerpt);
            
            // Set the description - handle CKEditor 5 if present
            if (window.descriptionEditor) {
                window.descriptionEditor.setData(randomDescription);
            } else {
                $('#description').val(randomDescription);
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
    
    // ========== CKEDITOR INITIALIZATION ==========
    var descriptionEditor = null;
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'blockQuote', 'insertTable', 'undo', 'redo']
        })
        .then(editor => {
            descriptionEditor = editor;
            window.descriptionEditor = editor; // Make available globally
            
            // Sync CKEditor content to textarea before form submit
            document.querySelector('#product-form').addEventListener('submit', function() {
                document.querySelector('#description').value = editor.getData();
            });
        })
        .catch(error => {
            console.error('CKEditor error:', error);
        });
</script>
@endsection
