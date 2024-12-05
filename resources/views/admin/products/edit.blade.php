@extends('layouts.admin')

@section('styles')
    @parent
    <style>
        #clientPricingTable input[type="number"], #clientPricingTable input[type="text"] { border: none!important; border-bottom: 1px solid #ccc!important; outline: none!important; border-radius:0!important; width: 100%; padding: 5px; box-sizing: border-box; background-color: transparent; }
        #clientPricingTable input[type="number"]:focus, #clientPricingTable input[type="text"]:focus { border: none!important; outline: none!important; }
        #clientPricingTable { border-collapse: collapse; }
        #clientPricingTable th, #clientPricingTable td { padding: 10px; text-align: left; }
    </style>

@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
        </div>

        <div class="card-body">
        <form method="POST" action="{{ route('admin.products.update', [$product->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="published">Published</label>
                                    <select name="published" class="form-control">
                                        <option value="1" {{ $product->published == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $product->published == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-center">
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">Featured</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="quantity">{{ trans('cruds.product.fields.quantity') }}</label>
                                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" step="1">
                                @if($errors->has('quantity'))
                                <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.quantity_helper') }}</span>
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
                        @include('admin.products.partials.product_category')

                    </div>


                    <!-- Pricing Tab -->
                    <div class="tab-pane fade" id="vert-tabs-pricing" role="tabpanel" aria-labelledby="vert-tabs-pricing-tab">
                        {{-- @include('admin.products.partials.client_prices')--}}
                        @include('admin.products.partials.client_prices', [
                                    'product' => $product,
                                    'clients' => $clients
                                ])
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
        window.categories = @json($categories);
        // console.log(clientsData);
        // console.log(clientPrices);
        // console.log(categories);


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

    <script>

        window.clientsData = @json($clients);
        window.clientPrices = @json($product->clientPrices);
        window.categories = @json($categories);

        document.addEventListener('DOMContentLoaded', function() {

            $('#clientSelect').select2();

            // Pre-populate existing client rows to ensure they are displayed correctly
            $('#clientSelect').find('option:selected').each(function() {
                const clientId = $(this).val();
                const clientName = $(this).text();

                // Ensure the existing client row is visible (in case it was hidden previously)
                if (!document.querySelector(`#pricing-row-${clientId}`)) {
                    // Existing rows are already rendered via Blade, only ensure visibility
                    document.querySelector(`#pricing-row-${clientId}`).style.display = '';
                }
            });

            $('#clientSelect').on('select2:select', function(e) {
                const clientId = e.params.data.id;
                const clientName = e.params.data.text;

                // Add a client pricing row if it does not already exist
                if (!document.querySelector(`#pricing-row-${clientId}`)) {
                    addClientPricingRow(clientId, clientName, false);
                } else {
                    // If row already exists, ensure the row is visible (in case it was hidden)
                    document.querySelector(`#pricing-row-${clientId}`).style.display = '';
                }
            });

            // Event listener for unselecting a client (optional, for removing rows)
            $('#clientSelect').on('select2:unselect', function (e) {
                const clientId = e.params.data.id;
                const row = document.querySelector(`#pricing-row-${clientId}`);
                if (row) {
                    row.style.display = 'none'; // Hide the row instead of removing it to keep existing data
                }
            });

            // Function to add a new row to the client pricing table
            function addClientPricingRow(clientId, clientName, isExisting) {
                const tableBody = document.getElementById('clientPricingTableBody');

                // Create a new row for client pricing
                const row = document.createElement('tr');
                row.className = 'client-pricing-row';
                row.id = `pricing-row-${clientId}`;

                row.innerHTML = `
                    <td>${clientName}</td>
                    <td><input type="number" name="client_prices[${clientId}][price]" class="form-control" required></td>
                    <td><input type="text" name="client_prices[${clientId}][sku]" class="form-control"></td>
                    <td><input type="text" name="client_prices[${clientId}][mpn]" class="form-control"></td>
                    <td><input type="text" name="client_prices[${clientId}][gtin]" class="form-control"></td>
                    <td><input type="text" name="client_prices[${clientId}][upc]" class="form-control"></td>
                    <td><input type="text" name="client_prices[${clientId}][qb_1]" class="form-control"></td>
                    <td><input type="text" name="client_prices[${clientId}][qb_2]" class="form-control"></td>
                    <input type="hidden" name="client_prices[${clientId}][published]" value="true">
                `;

                tableBody.appendChild(row);
            }
        });



        $('#addCategory').on('click', function() {
            var categoryName = prompt("Enter new product category name:");
            if (!categoryName) return;

            $.ajax({
                url: '/admin/product-categories/store-ajax',
                type: 'POST',
                data: {
                    name: categoryName,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var newOption = new Option(response.name, response.id, true, true);
                    $('#categories').append(newOption).trigger('change');
                },
                error: function(xhr, status, error) {
                    alert("Error adding product category: " + error);
                }
            });
        });

        $('#addClient').on('click', function() {
            var clientName = prompt("Enter new client name:");
            if (!clientName) return;

            $.ajax({
                url: '/admin/clients/store-ajax', // Adjust this URL as needed
                type: 'POST',
                data: {
                    name: clientName,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var newOption = new Option(response.name, response.id, true, true);
                    $('#clientSelect').append(newOption).trigger('change');
                },
                error: function(xhr, status, error) {
                    alert("Error adding client: " + error);
                }
            });
        });
    </script>
@endsection

