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
                @include('admin.products.partials.tab-headers')


                <!-- Tab Content -->
                <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                    <!-- General Tab -->
                    <div class="tab-pane text-left fade show active" id="vert-tabs-gen" role="tabpanel" aria-labelledby="vert-tabs-gen-tab">
                        @include('admin.products.partials.general')

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
                        @include('admin.products.partials.categories')
                    </div>

                    <!-- Pricing Tab -->
                    <div class="tab-pane fade" id="vert-tabs-pricing" role="tabpanel" aria-labelledby="vert-tabs-pricing-tab">
                        @include('admin.products.partials.client_prices')
                    </div>

                    <!-- Settings Tab -->
                    <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                        @include('admin.products.partials.settings')
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
    // CoreUI Tab Switching JS
    const triggerTabList = [].slice.call(document.querySelectorAll('#v-pills-tab button'))
    triggerTabList.forEach(function (triggerEl) {
        const tabTrigger = new coreui.Tab(triggerEl)

        triggerEl.addEventListener('click', function (event) {
            event.preventDefault()
            tabTrigger.show()
        })
    })

    // Dynamically show pricing fields for selected clients
    document.addEventListener('DOMContentLoaded', function () {
        const clientsDropdown = document.getElementById('clients');
        const pricingFieldsContainer = document.getElementById('client-pricing-fields');

        clientsDropdown.addEventListener('change', function () {
            pricingFieldsContainer.innerHTML = ''; // Clear any existing fields

            const selectedClients = Array.from(this.selectedOptions).map(option => option.value);
            selectedClients.forEach(clientId => {
                const pricingRow = `
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="price-${clientId}">Price</label>
                            <input type="number" name="prices[${clientId}]" id="price-${clientId}" class="form-control" placeholder="Enter price">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="sku-${clientId}">SKU</label>
                            <input type="text" name="skus[${clientId}]" id="sku-${clientId}" class="form-control" placeholder="Enter SKU">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="mpn-${clientId}">MPN</label>
                            <input type="text" name="mpns[${clientId}]" id="mpn-${clientId}" class="form-control" placeholder="Enter MPN">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="gtin-${clientId}">GTIN</label>
                            <input type="text" name="gtins[${clientId}]" id="gtin-${clientId}" class="form-control" placeholder="Enter GTIN">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="upc-${clientId}">UPC</label>
                            <input type="text" name="upcs[${clientId}]" id="upc-${clientId}" class="form-control" placeholder="Enter UPC">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="qb1-${clientId}">QB 1</label>
                            <input type="text" name="qb_1[${clientId}]" id="qb1-${clientId}" class="form-control" placeholder="Enter QB 1">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="qb2-${clientId}">QB 2</label>
                            <input type="text" name="qb_2[${clientId}]" id="qb2-${clientId}" class="form-control" placeholder="Enter QB 2">
                        </div>
                    </div>
                `;
                pricingFieldsContainer.insertAdjacentHTML('beforeend', pricingRow);
            });
        });
    });

    // Dropzone Configuration for Photo Upload
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

