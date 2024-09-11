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

            <div class="d-flex align-items-start">
                <!-- Vertical Pills Navigation -->
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-general-tab" data-coreui-toggle="pill" data-coreui-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="true">
                        General
                    </button>
                    <button class="nav-link" id="v-pills-categories-tab" data-coreui-toggle="pill" data-coreui-target="#v-pills-categories" type="button" role="tab" aria-controls="v-pills-categories" aria-selected="false">
                        Categories
                    </button>
                    <button class="nav-link" id="v-pills-pricing-tab" data-coreui-toggle="pill" data-coreui-target="#v-pills-pricing" type="button" role="tab" aria-controls="v-pills-pricing" aria-selected="false">
                        Pricing
                    </button>
                    <button class="nav-link" id="v-pills-settings-tab" data-coreui-toggle="pill" data-coreui-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        Settings
                    </button>
                </div>

                <!-- Tab Content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- General Tab -->
                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab" tabindex="0">
                        @include('admin.products.partials.general')

                        <!-- Photo Upload using Dropzone -->
                        <div class="form-group mt-4">
                            <label for="photo">Product Photo</label>
                            <div class="needsclick dropzone" id="photo-dropzone"></div>
                        </div>
                    </div>

                    <!-- Categories Tab -->
                    <div class="tab-pane fade" id="v-pills-categories" role="tabpanel" aria-labelledby="v-pills-categories-tab" tabindex="0">
                        @include('admin.products.partials.categories')
                    </div>

                    <!-- Pricing Tab -->
                    <div class="tab-pane fade" id="v-pills-pricing" role="tabpanel" aria-labelledby="v-pills-pricing-tab" tabindex="0">
                        <div class="form-group">
                            <label for="clients">Select Clients</label>
                            <select class="form-control select2" name="clients[]" id="clients" multiple>
                                @foreach($clients as $id => $client)
                                    <option value="{{ $id }}">{{ $client }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Client Pricing Fields -->
                        <div id="client-pricing-fields" class="mt-4">
                            <!-- Client-specific pricing fields will be dynamically added here -->
                        </div>
                    </div>

                    <!-- Settings Tab -->
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
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
@endsection

