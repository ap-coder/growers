@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.orderItem.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.order-items.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="product_id">{{ trans('cruds.orderItem.fields.product') }}</label>
                            <select class="form-control select2" name="product_id" id="product_id">
                                @foreach($products as $id => $entry)
                                    <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.product_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="gtin">{{ trans('cruds.orderItem.fields.gtin') }}</label>
                            <input class="form-control" type="text" name="gtin" id="gtin" value="{{ old('gtin', '') }}">
                            @if($errors->has('gtin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gtin') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.gtin_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sku">{{ trans('cruds.orderItem.fields.sku') }}</label>
                            <input class="form-control" type="text" name="sku" id="sku" value="{{ old('sku', '') }}">
                            @if($errors->has('sku'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sku') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.sku_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mpn">{{ trans('cruds.orderItem.fields.mpn') }}</label>
                            <input class="form-control" type="text" name="mpn" id="mpn" value="{{ old('mpn', '') }}">
                            @if($errors->has('mpn'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mpn') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.mpn_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('cruds.orderItem.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="quantity">{{ trans('cruds.orderItem.fields.quantity') }}</label>
                            <input class="form-control" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="1">
                            @if($errors->has('quantity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('quantity') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.quantity_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_price">{{ trans('cruds.orderItem.fields.total_price') }}</label>
                            <input class="form-control" type="number" name="total_price" id="total_price" value="{{ old('total_price', '') }}" step="0.01">
                            @if($errors->has('total_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderItem.fields.total_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="items_id">{{ trans('cruds.orderItem.fields.items') }}</label>
                            <select class="form-control select2" name="items_id" id="items_id">
                                @foreach($items as $id => $entry)
                                    <option value="{{ $id }}" {{ old('items_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('items'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('items') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection