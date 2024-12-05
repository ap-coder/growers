@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.orderItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-items.update", [$orderItem->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.orderItem.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $orderItem->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gtin">{{ trans('cruds.orderItem.fields.gtin') }}</label>
                <input class="form-control {{ $errors->has('gtin') ? 'is-invalid' : '' }}" type="text" name="gtin" id="gtin" value="{{ old('gtin', $orderItem->gtin) }}">
                @if($errors->has('gtin'))
                    <span class="text-danger">{{ $errors->first('gtin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.gtin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sku">{{ trans('cruds.orderItem.fields.sku') }}</label>
                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text" name="sku" id="sku" value="{{ old('sku', $orderItem->sku) }}">
                @if($errors->has('sku'))
                    <span class="text-danger">{{ $errors->first('sku') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.sku_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mpn">{{ trans('cruds.orderItem.fields.mpn') }}</label>
                <input class="form-control {{ $errors->has('mpn') ? 'is-invalid' : '' }}" type="text" name="mpn" id="mpn" value="{{ old('mpn', $orderItem->mpn) }}">
                @if($errors->has('mpn'))
                    <span class="text-danger">{{ $errors->first('mpn') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.mpn_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.orderItem.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $orderItem->price) }}" step="0.01">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.orderItem.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $orderItem->quantity) }}" step="1">
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_price">{{ trans('cruds.orderItem.fields.total_price') }}</label>
                <input class="form-control {{ $errors->has('total_price') ? 'is-invalid' : '' }}" type="number" name="total_price" id="total_price" value="{{ old('total_price', $orderItem->total_price) }}" step="0.01">
                @if($errors->has('total_price'))
                    <span class="text-danger">{{ $errors->first('total_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.orderItem.fields.total_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="items_id">{{ trans('cruds.orderItem.fields.items') }}</label>
                <select class="form-control select2 {{ $errors->has('items') ? 'is-invalid' : '' }}" name="items_id" id="items_id">
                    @foreach($items as $id => $entry)
                        <option value="{{ $id }}" {{ (old('items_id') ? old('items_id') : $orderItem->items->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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