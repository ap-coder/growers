@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.clientPrice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.client-prices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.clientPrice.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPrice.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.clientPrice.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPrice.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sku">{{ trans('cruds.clientPrice.fields.sku') }}</label>
                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text" name="sku" id="sku" value="{{ old('sku', '') }}">
                @if($errors->has('sku'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sku') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPrice.fields.sku_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mpn">{{ trans('cruds.clientPrice.fields.mpn') }}</label>
                <input class="form-control {{ $errors->has('mpn') ? 'is-invalid' : '' }}" type="text" name="mpn" id="mpn" value="{{ old('mpn', '') }}">
                @if($errors->has('mpn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mpn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPrice.fields.mpn_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gtin">{{ trans('cruds.clientPrice.fields.gtin') }}</label>
                <input class="form-control {{ $errors->has('gtin') ? 'is-invalid' : '' }}" type="text" name="gtin" id="gtin" value="{{ old('gtin', '') }}">
                @if($errors->has('gtin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gtin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPrice.fields.gtin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="upc">{{ trans('cruds.clientPrice.fields.upc') }}</label>
                <input class="form-control {{ $errors->has('upc') ? 'is-invalid' : '' }}" type="text" name="upc" id="upc" value="{{ old('upc', '') }}">
                @if($errors->has('upc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('upc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPrice.fields.upc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qb_1">{{ trans('cruds.clientPrice.fields.qb_1') }}</label>
                <input class="form-control {{ $errors->has('qb_1') ? 'is-invalid' : '' }}" type="text" name="qb_1" id="qb_1" value="{{ old('qb_1', '') }}">
                @if($errors->has('qb_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qb_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPrice.fields.qb_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qb_2">{{ trans('cruds.clientPrice.fields.qb_2') }}</label>
                <input class="form-control {{ $errors->has('qb_2') ? 'is-invalid' : '' }}" type="text" name="qb_2" id="qb_2" value="{{ old('qb_2', '') }}">
                @if($errors->has('qb_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qb_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPrice.fields.qb_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="barcode_image">{{ trans('cruds.clientPrice.fields.barcode_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('barcode_image') ? 'is-invalid' : '' }}" id="barcode_image-dropzone">
                </div>
                @if($errors->has('barcode_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('barcode_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPrice.fields.barcode_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.clientPrice.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.clientPrice.fields.client_helper') }}</span>
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
    Dropzone.options.barcodeImageDropzone = {
    url: '{{ route('admin.client-prices.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 600,
      height: 600
    },
    success: function (file, response) {
      $('form').find('input[name="barcode_image"]').remove()
      $('form').append('<input type="hidden" name="barcode_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="barcode_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($clientPrice) && $clientPrice->barcode_image)
      var file = {!! json_encode($clientPrice->barcode_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="barcode_image" value="' + file.file_name + '">')
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
@endsection