@extends('layouts.admin')
@section('content')

<form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data" id="product-form">
    @csrf
    
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="product-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab">
                        <i class="fas fa-info-circle mr-1"></i> General
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pricing-tab" data-toggle="tab" href="#pricing" role="tab">
                        <i class="fas fa-dollar-sign mr-1"></i> Pricing & IDs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab">
                        <i class="fas fa-tags mr-1"></i> Categories & Tags
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="media-tab" data-toggle="tab" href="#media" role="tab">
                        <i class="fas fa-images mr-1"></i> Media
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="access-tab" data-toggle="tab" href="#access" role="tab">
                        <i class="fas fa-users mr-1"></i> Client Access
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            {{-- Top Row: Checkboxes --}}
            <div class="row mb-2">
                <div class="col-12">
                    <div class="icheck-primary d-inline mr-3">
                        <input type="hidden" name="published" value="0">
                        <input type="checkbox" name="published" id="published" value="1" {{ old('published', 1) == 1 ? 'checked' : '' }}>
                        <label for="published">Published</label>
                    </div>
                    <div class="icheck-success d-inline" id="featured_group">
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', 0) == 1 ? 'checked' : '' }}>
                        <label for="featured">Featured</label>
                    </div>
                </div>
            </div>
            {{-- Second Row: Selects --}}
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group mb-0">
                        <label for="product_type" class="col-form-label-sm mb-0">Product Type</label>
                        <select class="form-control form-control-sm" name="product_type" id="product_type">
                            @foreach(\App\Models\Product::TYPE_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('product_type', 'standard') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-0">
                        <label for="layout" class="col-form-label-sm mb-0">Layout</label>
                        <select class="form-control form-control-sm" name="layout" id="layout">
                            @foreach(\App\Models\Product::LAYOUT_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('layout', 'default') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2" id="quantity_group">
                    <div class="form-group mb-0">
                        <label for="quantity" class="col-form-label-sm mb-0">Quantity</label>
                        <input class="form-control form-control-sm" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="1">
                    </div>
                </div>
            </div>
            
            <div class="tab-content" id="product-tabs-content">
                {{-- General Tab --}}
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    
                    <div class="form-group" id="accessory_type_group" style="display: none;">
                        <label for="accessory_type_id">Accessory Type</label>
                        <select class="form-control {{ $errors->has('accessory_type_id') ? 'is-invalid' : '' }}" name="accessory_type_id" id="accessory_type_id">
                            <option value="">-- Select Type --</option>
                            @foreach(\App\Models\AccessoryType::orderBy('name')->get() as $type)
                                <option value="{{ $type->id }}" {{ old('accessory_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('accessory_type_id'))
                            <span class="text-danger">{{ $errors->first('accessory_type_id') }}</span>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                </div>
                
                {{-- Pricing Tab --}}
                <div class="tab-pane fade" id="pricing" role="tabpanel">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="base_price">Base Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control {{ $errors->has('base_price') ? 'is-invalid' : '' }}" type="number" step="0.01" name="base_price" id="base_price" value="{{ old('base_price', '') }}">
                                </div>
                                <small class="text-muted">Default price (can be overridden per client)</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sku">SKU</label>
                                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text" name="sku" id="sku" value="{{ old('sku', '') }}">
                                <small class="text-muted">Internal product code</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="upc_code">UPC Code</label>
                                <input class="form-control {{ $errors->has('upc_code') ? 'is-invalid' : '' }}" type="text" name="upc_code" id="upc_code" value="{{ old('upc_code', '') }}">
                                <small class="text-muted">For order tickets</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="qb_1">QuickBooks ID 1</label>
                                <input class="form-control {{ $errors->has('qb_1') ? 'is-invalid' : '' }}" type="text" name="qb_1" id="qb_1" value="{{ old('qb_1', '') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="qb_2">QuickBooks ID 2</label>
                                <input class="form-control {{ $errors->has('qb_2') ? 'is-invalid' : '' }}" type="text" name="qb_2" id="qb_2" value="{{ old('qb_2', '') }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Categories Tab --}}
                <div class="tab-pane fade" id="categories" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6" id="categories_section">
                            <div class="form-group">
                                <label for="categories">{{ trans('cruds.product.fields.category') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                                    @foreach($categories as $id => $category)
                                        <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="tags_section">
                            <div class="form-group">
                                <label for="tags">{{ trans('cruds.product.fields.tag') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                                    @foreach($tags as $id => $tag)
                                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Media Tab --}}
                <div class="tab-pane fade" id="media" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="photo">{{ trans('cruds.product.fields.photo') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                                </div>
                                @if($errors->has('photo'))
                                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                                @endif
                                <small class="text-muted">Main product image</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="additional_photos">{{ trans('cruds.product.fields.additional_photos') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('additional_photos') ? 'is-invalid' : '' }}" id="additional_photos-dropzone">
                                </div>
                                @if($errors->has('additional_photos'))
                                    <span class="text-danger">{{ $errors->first('additional_photos') }}</span>
                                @endif
                                <small class="text-muted">Additional gallery images</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Client Access Tab --}}
                <div class="tab-pane fade" id="access" role="tabpanel">
                    <div class="form-group">
                        <label for="clients">{{ trans('cruds.product.fields.clients') }}</label>
                        <p class="text-muted small mb-2">All clients are selected by default. Remove clients that should not have access to this product.</p>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('clients') ? 'is-invalid' : '' }}" name="clients[]" id="clients" multiple>
                            @php
                                $defaultClients = old('clients', array_keys($clients->toArray()));
                            @endphp
                            @foreach($clients as $id => $client)
                                <option value="{{ $id }}" {{ in_array($id, $defaultClients) ? 'selected' : '' }}>{{ $client }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-save mr-1"></i> {{ trans('global.save') }}
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="fas fa-times mr-1"></i> Cancel
            </a>
        </div>
    </div>
</form>



@endsection

@section('scripts')
<script>
    // Show/hide sections based on product type selection
    $(function() {
        function toggleProductTypeSections() {
            var type = $('#product_type').val();
            
            // Accessory type field - only for accessories
            if (type === 'accessory') {
                $('#accessory_type_group').show();
            } else {
                $('#accessory_type_group').hide();
            }
            
            // Categories & Tags - hide for accessories (they use accessory types instead)
            if (type === 'accessory') {
                $('#categories_section').hide();
                $('#tags_section').hide();
            } else {
                $('#categories_section').show();
                $('#tags_section').show();
            }
            
            // Featured checkbox - hide for accessories
            if (type === 'accessory') {
                $('#featured_group').hide();
            } else {
                $('#featured_group').show();
            }
            
            // Quantity - hide for sets (calculated from bundle items)
            if (type === 'set') {
                $('#quantity_group').hide();
            } else {
                $('#quantity_group').show();
            }
        }
        $('#product_type').on('change', toggleProductTypeSections);
        toggleProductTypeSections();
    });

    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->photo)
      var file = {!! json_encode($product->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    var uploadedAdditionalPhotosMap = {}
Dropzone.options.additionalPhotosDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="additional_photos[]" value="' + response.name + '">')
      uploadedAdditionalPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAdditionalPhotosMap[file.name]
      }
      $('form').find('input[name="additional_photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($product) && $product->additional_photos)
      var files = {!! json_encode($product->additional_photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="additional_photos[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection
