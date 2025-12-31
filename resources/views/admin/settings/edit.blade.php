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
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', $setting->value) }}">
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
            </div>
            <div class="form-group" id="value-textarea-group" style="display: none;">
                <label for="value_textarea">Value</label>
                <textarea class="form-control" name="value" id="value_textarea" rows="4">{{ old('value', $setting->value) }}</textarea>
            </div>
            <div class="form-group" id="value-image-group" style="display: none;">
                <label for="image_value">Image</label>
                @if($setting->type === 'image' && $setting->value)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $setting->value) }}" alt="Current Image" style="max-height: 150px;">
                    </div>
                @endif
                <input class="form-control {{ $errors->has('image_value') ? 'is-invalid' : '' }}" type="file" name="image_value" id="image_value" accept="image/*">
                @if($errors->has('image_value'))
                    <span class="text-danger">{{ $errors->first('image_value') }}</span>
                @endif
                <span class="help-block">Leave empty to keep current image</span>
            </div>
            <div class="form-group" id="value-boolean-group" style="display: none;">
                <div class="form-check">
                    <input type="hidden" name="value" value="0">
                    <input class="form-check-input" type="checkbox" name="value" id="value_boolean" value="1" {{ old('value', $setting->value) == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="value_boolean">Enabled</label>
                </div>
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
    function toggleValueFields() {
        var type = $('#type').val();
        $('#value-text-group, #value-textarea-group, #value-image-group, #value-boolean-group').hide();
        $('#value, #value_textarea').prop('disabled', true);
        
        if (type === 'text' || type === 'select') {
            $('#value-text-group').show();
            $('#value').prop('disabled', false);
        } else if (type === 'textarea') {
            $('#value-textarea-group').show();
            $('#value_textarea').prop('disabled', false);
        } else if (type === 'image') {
            $('#value-image-group').show();
        } else if (type === 'boolean') {
            $('#value-boolean-group').show();
        }
    }
    
    $('#type').on('change', toggleValueFields);
    toggleValueFields();
});
</script>
@endsection