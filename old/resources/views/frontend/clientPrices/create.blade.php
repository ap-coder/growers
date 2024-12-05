@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.clientPrice.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.client-prices.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="price">{{ trans('cruds.clientPrice.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.clientPrice.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sku">{{ trans('cruds.clientPrice.fields.sku') }}</label>
                            <input class="form-control" type="text" name="sku" id="sku" value="{{ old('sku', '') }}">
                            @if($errors->has('sku'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sku') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.clientPrice.fields.sku_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mpn">{{ trans('cruds.clientPrice.fields.mpn') }}</label>
                            <input class="form-control" type="text" name="mpn" id="mpn" value="{{ old('mpn', '') }}">
                            @if($errors->has('mpn'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mpn') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.clientPrice.fields.mpn_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="gtin">{{ trans('cruds.clientPrice.fields.gtin') }}</label>
                            <input class="form-control" type="text" name="gtin" id="gtin" value="{{ old('gtin', '') }}">
                            @if($errors->has('gtin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gtin') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.clientPrice.fields.gtin_helper') }}</span>
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