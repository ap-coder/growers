@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.orders.update", [$order->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="client_id">{{ trans('cruds.order.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id">
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $order->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="number">{{ trans('cruds.order.fields.number') }}</label>
                            <input class="form-control" type="number" name="number" id="number" value="{{ old('number', $order->number) }}" step="1">
                            @if($errors->has('number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.order.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Order::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $order->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="shipping_cost">{{ trans('cruds.order.fields.shipping_cost') }}</label>
                            <input class="form-control" type="number" name="shipping_cost" id="shipping_cost" value="{{ old('shipping_cost', $order->shipping_cost) }}" step="0.01">
                            @if($errors->has('shipping_cost'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('shipping_cost') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.shipping_cost_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="order_total">{{ trans('cruds.order.fields.order_total') }}</label>
                            <input class="form-control" type="number" name="order_total" id="order_total" value="{{ old('order_total', $order->order_total) }}" step="0.01">
                            @if($errors->has('order_total'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order_total') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.order_total_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_price">{{ trans('cruds.order.fields.total_price') }}</label>
                            <input class="form-control" type="number" name="total_price" id="total_price" value="{{ old('total_price', $order->total_price) }}" step="0.01">
                            @if($errors->has('total_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.total_price_helper') }}</span>
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