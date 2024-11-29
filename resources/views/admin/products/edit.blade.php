@extends('layouts.admin')

@section('content')

    <div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.update', [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">

            {{-- @include('admin.products.partials.tab-headers') --}}

                <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-gen-tab" data-toggle="pill" href="#vert-tabs-gen" role="tab" aria-controls="vert-tabs-gen" aria-selected="true">General</a>
                            <a class="nav-link" id="vert-tabs-cat-tab" data-toggle="pill" href="#vert-tabs-cat" role="tab" aria-controls="vert-tabs-cat" aria-selected="false">Categories</a>
                            <a class="nav-link" id="vert-tabs-pricing-tab" data-toggle="pill" href="#vert-tabs-pricing" role="tab" aria-controls="vert-tabs-pricing" aria-selected="false">Pricing</a>
                            <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Settings</a>
                        </div>
                </div>


                <!-- Tab Content -->
                <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                    <!-- General Tab -->
                    <div class="tab-pane text-left fade show active" id="vert-tabs-gen" role="tabpanel" aria-labelledby="vert-tabs-gen-tab">
                        {{-- @include('admin.products.partials.general') --}}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="published">Published</label>
                                    <select name="published" class="form-control">
                                        <option value="1" {{ $product->published == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $product->published == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">Featured</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                        </div>


                        <!-- Photo Upload using Dropzone -->
                        <div class="form-group mt-4">
                            <label for="photo">Product Photo</label>
                            <div class="needsclick dropzone" id="photo-dropzone"></div>
                        </div>

                        <div class="form-group">
                            <label for="additional_photos">{{ trans('cruds.product.fields.additional_photos') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('additional_photos') ? 'is-invalid' : '' }}" id="additional_photos-dropzone">
                            </div>
                            @if($errors->has('additional_photos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('additional_photos') }}
                                    </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.additional_photos_helper') }}</span>
                        </div>
                    </div>

                    <!-- Categories Tab -->
                    <div class="tab-pane fade" id="vert-tabs-cat" role="tabpanel" aria-labelledby="vert-tabs-cat-tab">
                        {{-- @include('admin.products.partials.categories') --}}

                        <div class="form-group">
                            <label for="product_categories">{{ trans('cruds.product.fields.category') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2 {{ $errors->has('product_categories') ? 'is-invalid' : '' }}" style="width: 100%;" name="product_categories[]" id="product_categories" multiple>
                                @foreach($product_categories as $id => $category)
                                    <option value="{{ $id }}" {{ in_array($id, old('product_categories', $product->product_categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->has('product_categories'))
                                <span class="text-danger">{{ $errors->first('product_categories') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                        </div>



                        <div class="form-group">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductCategoryModal">
                                Add New Product Category
                            </button>
                        </div>

                        <div class="modal fade" id="addProductCategoryModal" tabindex="-1" aria-labelledby="addProductCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addProductCategoryModalLabel">Add New Product Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addProductCategoryForm">
                                            @csrf
                                            <div class="form-group">
                                                <label for="product-category-name">Product Category Name</label>
                                                <input type="text" class="form-control" id="product-category-name" name="product_category_name" required>
                                            </div>
                                            <div id="product-category-error" class="text-danger"></div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="saveProductCategoryButton">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- @include('admin.products.partials.add-category-modal') --}}
                    </div>


                    <!-- Pricing Tab -->
                    <div class="tab-pane fade" id="vert-tabs-pricing" role="tabpanel" aria-labelledby="vert-tabs-pricing-tab">
                        {{-- @include('admin.products.partials.client_prices') --}}

                    </div>

                    <!-- Settings Tab -->
                    <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                        {{--  @include('admin.products.partials.settings') --}}


                    </div>
                </div>
            </div>

                <!-- Submit Button -->
            <div class="form-group mt-4">
                <button class="btn btn-danger" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
    <script>
    window.clientsData = @json($clients);
    window.clientPrices = @json($product->clientPrices);
    window.productCategories = @json($product_categories);
    console.log(clientsData);
    console.log(clientPrices);
    console.log(productCategories);

    Dropzone.options.photoDropzone = {
        url: '{{ route('admin.products.storeMedia') }}',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 20,
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
                var message = response; // Dropzone sends its own error messages in string format
            } else {
                var message = response.errors.file;
            }
            file.previewElement.classList.add('dz-error');
            var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _ref.forEach(function(node) {
                node.textContent = message;
            });
        }
    }

    var uploadedAdditionalPhotosMap = {}

    Dropzone.options.additionalPhotosDropzone = {
        url: '{{ route('admin.products.storeMedia') }}',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 20,
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

