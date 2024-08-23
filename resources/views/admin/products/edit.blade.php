@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <!-- Product Name -->
                <div class="form-group">
                    <label for="name">{{ trans('cruds.product.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                </div>

                <!-- Product Description -->
                <div class="form-group">
                    <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                    @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
                </div>

                <!-- Product Categories -->
                <div class="form-group">
                    <label for="categories">{{ trans('cruds.product.fields.categories') }}</label>
                    <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                        @foreach($categories as $id => $category)
                            <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $product->categories->contains($id)) ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('categories'))
                        <div class="invalid-feedback">
                            {{ $errors->first('categories') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.categories_helper') }}</span>
                </div>

                <!-- Product Tags -->
                <div class="form-group">
                    <label for="tags">{{ trans('cruds.product.fields.tags') }}</label>
                    <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                        @foreach($tags as $id => $tag)
                            <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $product->tags->contains($id)) ? 'selected' : '' }}>
                                {{ $tag }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('tags'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tags') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.tags_helper') }}</span>
                </div>

                <!-- Product Photo -->
                <div class="form-group">
                    <label for="photo">{{ trans('cruds.product.fields.photo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                    </div>
                    @if($errors->has('photo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('photo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.photo_helper') }}</span>
                </div>

                <!-- Client Selection -->
                <div class="form-group">
                    <label for="clients">{{ trans('cruds.product.fields.clients') }}</label>
                    <select class="form-control select2 {{ $errors->has('clients') ? 'is-invalid' : '' }}" name="clients[]" id="clients" multiple>
                        @foreach($clients as $id => $client)
                            <option value="{{ $id }}" {{ (in_array($id, old('clients', [])) || $product->clients->contains($id)) ? 'selected' : '' }}>
                                {{ $client }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('clients'))
                        <div class="invalid-feedback">
                            {{ $errors->first('clients') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.clients_helper') }}</span>
                </div>

                <!-- Client Pricing Fields -->
                <div id="client-pricing-section">
                    @foreach($product->clients as $client)
                        <div class="client-pricing-group">
                            <h4>{{ $client->name }}</h4>
                            <div class="form-group">
                                <label for="prices[{{ $client->id }}]">{{ trans('cruds.clientPrice.fields.price') }}</label>
                                <input class="form-control {{ $errors->has('prices.'.$client->id) ? 'is-invalid' : '' }}" type="number" name="prices[{{ $client->id }}]" id="prices[{{ $client->id }}]" value="{{ old('prices.'.$client->id, $client->pivot->price) }}" step="0.01">
                                @if($errors->has('prices.'.$client->id))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('prices.'.$client->id) }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.clientPrice.fields.price_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="skus[{{ $client->id }}]">{{ trans('cruds.clientPrice.fields.sku') }}</label>
                                <input class="form-control {{ $errors->has('skus.'.$client->id) ? 'is-invalid' : '' }}" type="text" name="skus[{{ $client->id }}]" id="skus[{{ $client->id }}]" value="{{ old('skus.'.$client->id, $client->pivot->sku) }}">
                                @if($errors->has('skus.'.$client->id))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('skus.'.$client->id) }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.clientPrice.fields.sku_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="mpns[{{ $client->id }}]">{{ trans('cruds.clientPrice.fields.mpn') }}</label>
                                <input class="form-control {{ $errors->has('mpns.'.$client->id) ? 'is-invalid' : '' }}" type="text" name="mpns[{{ $client->id }}]" id="mpns[{{ $client->id }}]" value="{{ old('mpns.'.$client->id, $client->pivot->mpn) }}">
                                @if($errors->has('mpns.'.$client->id))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('mpns.'.$client->id) }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.clientPrice.fields.mpn_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="gtins[{{ $client->id }}]">{{ trans('cruds.clientPrice.fields.gtin') }}</label>
                                <input class="form-control {{ $errors->has('gtins.'.$client->id) ? 'is-invalid' : '' }}" type="text" name="gtins[{{ $client->id }}]" id="gtins[{{ $client->id }}]" value="{{ old('gtins.'.$client->id, $client->pivot->gtin) }}">
                                @if($errors->has('gtins.'.$client->id))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('gtins.'.$client->id) }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.clientPrice.fields.gtin_helper') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Submit Button -->
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
@endsection
