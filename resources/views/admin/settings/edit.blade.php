@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.setting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settings.update", [$setting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="key">{{ trans('cruds.setting.fields.key') }}</label>
                        <input class="form-control {{ $errors->has('key') ? 'is-invalid' : '' }}" type="text" name="key" id="key" value="{{ old('key', $setting->key) }}" required>
                        @if($errors->has('key'))
                            <span class="text-danger">{{ $errors->first('key') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="label">Label</label>
                        <input class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" type="text" name="label" id="label" value="{{ old('label', $setting->label) }}" required>
                        @if($errors->has('label'))
                            <span class="text-danger">{{ $errors->first('label') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="type">Type</label>
                        <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                            @foreach($types as $key => $label)
                                <option value="{{ $key }}" {{ old('type', $setting->type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('type'))
                            <span class="text-danger">{{ $errors->first('type') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="group">Group</label>
                        <select class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group" id="group" required>
                            @foreach($groups as $key => $label)
                                <option value="{{ $key }}" {{ old('group', $setting->group) == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('group'))
                            <span class="text-danger">{{ $errors->first('group') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group" id="value-text-group">
                <label for="value">{{ trans('cruds.setting.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', $setting->value) }}" disabled>
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
            </div>
            <div class="form-group" id="value-textarea-group" style="display: none;">
                <label for="value_textarea">Value</label>
                <textarea class="form-control" name="value" id="value_textarea" rows="4" disabled>{{ old('value', $setting->value) }}</textarea>
            </div>
            <div class="form-group" id="value-html-group" style="display: none;">
                <label for="value_html">Value (HTML)</label>
                <textarea class="form-control ckeditor" name="value" id="value_html" rows="8" disabled>{{ old('value', $setting->value) }}</textarea>
            </div>
            <div class="form-group" id="value-image-group" style="display: none;">
                <label for="image_value">Image</label>
                <div class="needsclick dropzone {{ $errors->has('image_value') ? 'is-invalid' : '' }}" id="image-dropzone"></div>
                @if($errors->has('image_value'))
                    <span class="text-danger">{{ $errors->first('image_value') }}</span>
                @endif
                <span class="help-block">Images will be automatically converted to WebP format.</span>
            </div>
            <div class="form-group" id="value-boolean-group" style="display: none;">
                <div class="form-check">
                    <input type="hidden" name="value_bool_fallback" id="value_boolean_hidden" value="0" disabled>
                    <input class="form-check-input" type="checkbox" name="value_bool" id="value_boolean" value="1" {{ old('value', $setting->value) == '1' ? 'checked' : '' }} disabled>
                    <label class="form-check-label" for="value_boolean">Enabled</label>
                </div>
            </div>
            <div class="form-group" id="value-select-group" style="display: none;">
                <label for="value_select">Value</label>
                <select class="form-control" name="value" id="value_select">
                    @if($setting->key === 'shop_layout')
                        @foreach(\App\Models\Setting::SHOP_LAYOUT_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('value', $setting->value) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    @elseif($setting->key === 'shop_default_view')
                        @foreach(\App\Models\Setting::SHOP_DEFAULT_VIEW_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('value', $setting->value) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    @elseif($setting->key === 'default_product_layout')
                        @foreach(\App\Models\Setting::PRODUCT_LAYOUT_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('value', $setting->value) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" rows="2">{{ old('description', $setting->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
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
@parent
<script>
$(function() {
    var settingKey = '{{ $setting->key }}';
    var selectSettings = ['shop_layout', 'shop_default_view', 'default_product_layout'];
    
    function toggleValueFields() {
        var type = $('#type').val();
        $('#value-text-group, #value-textarea-group, #value-html-group, #value-image-group, #value-boolean-group, #value-select-group').hide();
        $('#value, #value_textarea, #value_html, #value_select, #value_boolean, #value_boolean_hidden').prop('disabled', true);
        
        if (type === 'select' && selectSettings.includes(settingKey)) {
            $('#value-select-group').show();
            $('#value_select').prop('disabled', false);
        } else if (type === 'text') {
            $('#value-text-group').show();
            $('#value').prop('disabled', false);
        } else if (type === 'textarea') {
            $('#value-textarea-group').show();
            $('#value_textarea').prop('disabled', false);
        } else if (type === 'html') {
            $('#value-html-group').show();
            $('#value_html').prop('disabled', false);
        } else if (type === 'image') {
            $('#value-image-group').show();
        } else if (type === 'boolean') {
            $('#value-boolean-group').show();
            $('#value_boolean, #value_boolean_hidden').prop('disabled', false);
        }
    }
    
    $('#type').on('change', toggleValueFields);
    toggleValueFields();
});

// Dropzone configuration for image upload
var uploadedImageMap = {};
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.settings.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
        size: 2
    },
    success: function (file, response) {
        $('form').append('<input type="hidden" name="image_value" value="' + response.name + '">');
        uploadedImageMap[file.name] = response.name;
    },
    removedfile: function (file) {
        file.previewElement.remove();
        if (file.status !== 'error') {
            $('form').find('input[name="image_value"]').remove();
            this.options.maxFiles = this.options.maxFiles + 1;
        }
    },
    init: function () {
        @if($setting->image)
            var file = {!! json_encode($setting->image) !!};
            this.options.addedfile.call(this, file);
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url);
            file.previewElement.classList.add('dz-complete');
            $('form').append('<input type="hidden" name="image_value" value="' + file.file_name + '">');
            this.options.maxFiles = this.options.maxFiles - 1;
        @endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response;
        } else {
            var message = response.errors.file;
        }
        file.previewElement.classList.add('dz-error');
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]');
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    }
};
</script>
@endsection