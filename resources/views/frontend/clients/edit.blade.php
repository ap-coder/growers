@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.client.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.clients.update", [$client->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.client.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $client->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="products">{{ trans('cruds.client.fields.products') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="products[]" id="products" multiple>
                                @foreach($products as $id => $product)
                                    <option value="{{ $id }}" {{ (in_array($id, old('products', [])) || $client->products->contains($id)) ? 'selected' : '' }}>{{ $product }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('products'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('products') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.products_helper') }}</span>
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