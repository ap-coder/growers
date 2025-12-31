@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} Accessory
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.accessories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="accessory_type_id">Accessory Type</label>
                <select class="form-control select2 {{ $errors->has('accessory_type') ? 'is-invalid' : '' }}" name="accessory_type_id" id="accessory_type_id" required>
                    @foreach($accessoryTypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('accessory_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('accessory_type'))
                    <span class="text-danger">{{ $errors->first('accessory_type') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="sku">SKU</label>
                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text" name="sku" id="sku" value="{{ old('sku', '') }}">
                @if($errors->has('sku'))
                    <span class="text-danger">{{ $errors->first('sku') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="base_price">Base Price</label>
                <input class="form-control {{ $errors->has('base_price') ? 'is-invalid' : '' }}" type="number" name="base_price" id="base_price" value="{{ old('base_price', '') }}" step="0.01">
                @if($errors->has('base_price'))
                    <span class="text-danger">{{ $errors->first('base_price') }}</span>
                @endif
                <span class="help-block">Default price if no client-specific price is set</span>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', '1') ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">Published</label>
                </div>
            </div>
            <div class="form-group">
                <label for="sort_order">Sort Order</label>
                <input class="form-control {{ $errors->has('sort_order') ? 'is-invalid' : '' }}" type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', '0') }}">
                @if($errors->has('sort_order'))
                    <span class="text-danger">{{ $errors->first('sort_order') }}</span>
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
