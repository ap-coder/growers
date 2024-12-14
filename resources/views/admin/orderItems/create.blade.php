@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.orderItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-items.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.orderItem.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gtin">{{ trans('cruds.orderItem.fields.gtin') }}</label>
                <input class="form-control {{ $errors->has('gtin') ? 'is-invalid' : '' }}" type="text" name="gtin" id="gtin" value="{{ old('gtin', '') }}">
                @if($errors->has('gtin'))
                    <span class="text-danger">{{ $errors->first('gtin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.gtin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sku">{{ trans('cruds.orderItem.fields.sku') }}</label>
                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text" name="sku" id="sku" value="{{ old('sku', '') }}">
                @if($errors->has('sku'))
                    <span class="text-danger">{{ $errors->first('sku') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.sku_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mpn">{{ trans('cruds.orderItem.fields.mpn') }}</label>
                <input class="form-control {{ $errors->has('mpn') ? 'is-invalid' : '' }}" type="text" name="mpn" id="mpn" value="{{ old('mpn', '') }}">
                @if($errors->has('mpn'))
                    <span class="text-danger">{{ $errors->first('mpn') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.mpn_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.orderItem.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.orderItem.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="1">
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sub_total">{{ trans('cruds.orderItem.fields.sub_total') }}</label>
                <input class="form-control {{ $errors->has('sub_total') ? 'is-invalid' : '' }}" type="number" name="sub_total" id="sub_total" value="{{ old('sub_total', '') }}" step="0.01">
                @if($errors->has('sub_total'))
                    <span class="text-danger">{{ $errors->first('sub_total') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.sub_total_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="items_id">{{ trans('cruds.orderItem.fields.items') }}</label>
                <select class="form-control select2 {{ $errors->has('items') ? 'is-invalid' : '' }}" name="items_id" id="items_id">
                    @foreach($items as $id => $entry)
                        <option value="{{ $id }}" {{ old('items_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('items'))
                    <span class="text-danger">{{ $errors->first('items') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.items_helper') }}</span>
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
