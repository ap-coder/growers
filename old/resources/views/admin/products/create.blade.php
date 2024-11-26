@extends('layouts.admin')
@section('content')

    <div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_categories">{{ trans('cruds.product.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('product_categories') ? 'is-invalid' : '' }}" name="product_categories[]" id="product_categories" multiple>
                    @foreach($product_categories as $id => $category)
                        <option value="{{ $id }}" {{ in_array($id, old('product_categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
            </div>
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
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.product.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone"></div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="clients">{{ trans('cruds.product.fields.clients') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('clients') ? 'is-invalid' : '' }}" name="clients[]" id="clients" multiple>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ in_array($id, old('clients', [])) ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('clients'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clients') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.clients_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="additional_photos">{{ trans('cruds.product.fields.additional_photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('additional_photos') ? 'is-invalid' : '' }}" id="additional_photos-dropzone"></div>
                @if($errors->has('additional_photos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('additional_photos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.additional_photos_helper') }}</span>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
    <script>
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
            $('form').find('input[name="photo"]').remove();
            $('form').append('<input type="hidden" name="photo" value="' + response.name + '">');
        },
        removedfile: function (file) {
            file.previewElement.remove();
            if (file.status !== 'error') {
                $('form').find('input[name="photo"]').remove();
                this.options.maxFiles = this.options.maxFiles + 1;
            }
        }
    };

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
            $('form').append('<input type="hidden" name="additional_photos[]" value="' + response.name + '">');
        },
        removedfile: function (file) {
            console.log(file);
            file.previewElement.remove();
            $('form').find('input[name="additional_photos[]"][value="' + file.file_name + '"]').remove();
        }
    };
</script>

    <script>
    window.clientsData = @json($clients);

    document.getElementById("clients").addEventListener("change", function() {
        const selectedClientIds = Array.from(this.selectedOptions).map(option => option.value);
        updateClientPricingFields(selectedClientIds);
    });

    function updateClientPricingFields(clientIds) {
        const pricingTableBody = document.querySelector("#client-pricing-fields tbody");
        pricingTableBody.innerHTML = "";

        clientIds.forEach(clientId => {
            const clientName = getClientName(clientId);
            const newRow = `
                <tr data-client-id="${clientId}">
                    <td>${clientName}</td>
                    <td><input type="number" name="prices[${clientId}]" class="form-control" placeholder="Enter price"></td>
                    <td><input type="text" name="skus[${clientId}]" class="form-control" placeholder="Enter SKU"></td>
                    <td><input type="text" name="mpns[${clientId}]" class="form-control" placeholder="Enter MPN"></td>
                    <td><input type="text" name="gtins[${clientId}]" class="form-control" placeholder="Enter GTIN"></td>
                    <td><input type="text" name="upcs[${clientId}]" class="form-control" placeholder="Enter UPC"></td>
                    <td><input type="text" name="qb_1[${clientId}]" class="form-control" placeholder="Enter QB 1"></td>
                    <td><input type="text" name="qb_2[${clientId}]" class="form-control" placeholder="Enter QB 2"></td>
                </tr>
            `;
            pricingTableBody.insertAdjacentHTML("beforeend", newRow);
        });
    }

    function getClientName(clientId) {
        const clients = window.clientsData || {};
        return clients[clientId] || 'Unknown Client';
    }
</script>
@endsection
