@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }} #{{ $order->number }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="client_id">{{ trans('cruds.order.fields.client') }} <span class="text-danger">*</span></label><br>
                    <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                        @foreach($clients as $id => $entry)
                            <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $order->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('client'))
                        <span class="text-danger d-block">{{ $errors->first('client') }}</span>
                    @endif
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="number">{{ trans('cruds.order.fields.number') }}</label>
                        <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="number" name="number" id="number" value="{{ old('number', $order->number) }}" step="1">
                        @if($errors->has('number'))
                            <span class="text-danger">{{ $errors->first('number') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ trans('cruds.order.fields.status') }}</label>
                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\Order::STATUS_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('status', $order->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="delivery_date">Requested Delivery Date</label>
                        <input class="form-control date {{ $errors->has('delivery_date') ? 'is-invalid' : '' }}" type="text" name="delivery_date" id="delivery_date" value="{{ old('delivery_date', $order->delivery_date) }}">
                        @if($errors->has('delivery_date'))
                            <span class="text-danger">{{ $errors->first('delivery_date') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card card-outline card-secondary mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-user mr-1"></i> Order Contact Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ordered_by_name">Ordered By (Name)</label>
                                <input class="form-control {{ $errors->has('ordered_by_name') ? 'is-invalid' : '' }}" type="text" name="ordered_by_name" id="ordered_by_name" value="{{ old('ordered_by_name', $order->ordered_by_name) }}">
                                @if($errors->has('ordered_by_name'))
                                    <span class="text-danger">{{ $errors->first('ordered_by_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ordered_by_phone">Ordered By (Phone)</label>
                                <input class="form-control {{ $errors->has('ordered_by_phone') ? 'is-invalid' : '' }}" type="text" name="ordered_by_phone" id="ordered_by_phone" value="{{ old('ordered_by_phone', $order->ordered_by_phone) }}">
                                @if($errors->has('ordered_by_phone'))
                                    <span class="text-danger">{{ $errors->first('ordered_by_phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="store_location_request">Store Location Request</label>
                                <input class="form-control {{ $errors->has('store_location_request') ? 'is-invalid' : '' }}" type="text" name="store_location_request" id="store_location_request" value="{{ old('store_location_request', $order->store_location_request) }}">
                                @if($errors->has('store_location_request'))
                                    <span class="text-danger">{{ $errors->first('store_location_request') }}</span>
                                @endif
                                <small class="text-muted">e.g., Floral Dept, Front Display</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card card-outline card-secondary mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-comment-alt mr-1"></i> Order Notes & Instructions</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="special_request">Special Request <span class="badge badge-info">Visible to Customer</span></label>
                        <textarea class="form-control {{ $errors->has('special_request') ? 'is-invalid' : '' }}" name="special_request" id="special_request" rows="3">{{ old('special_request', $order->special_request) }}</textarea>
                        @if($errors->has('special_request'))
                            <span class="text-danger">{{ $errors->first('special_request') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="delivery_details">Delivery Details <span class="badge badge-info">Visible to Customer</span></label>
                        <textarea class="form-control {{ $errors->has('delivery_details') ? 'is-invalid' : '' }}" name="delivery_details" id="delivery_details" rows="2">{{ old('delivery_details', $order->delivery_details) }}</textarea>
                        @if($errors->has('delivery_details'))
                            <span class="text-danger">{{ $errors->first('delivery_details') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="internal_notes">Internal Notes <span class="badge badge-warning">Admin Only</span></label>
                        <textarea class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" name="internal_notes" id="internal_notes" rows="2">{{ old('internal_notes', $order->internal_notes) }}</textarea>
                        @if($errors->has('internal_notes'))
                            <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                        @endif
                        <small class="text-muted">These notes will NOT appear on packing slips or customer-facing documents</small>
                    </div>
                </div>
            </div>
            
            <div class="card card-outline card-secondary mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-dollar-sign mr-1"></i> Pricing & Totals</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shipping_cost">{{ trans('cruds.order.fields.shipping_cost') }}</label>
                                <input class="form-control {{ $errors->has('shipping_cost') ? 'is-invalid' : '' }}" type="number" name="shipping_cost" id="shipping_cost" value="{{ old('shipping_cost', $order->shipping_cost) }}" step="0.01">
                                @if($errors->has('shipping_cost'))
                                    <span class="text-danger">{{ $errors->first('shipping_cost') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="order_total">{{ trans('cruds.order.fields.order_total') }}</label>
                                <input class="form-control {{ $errors->has('order_total') ? 'is-invalid' : '' }}" type="number" name="order_total" id="order_total" value="{{ old('order_total', $order->order_total) }}" step="0.01">
                                @if($errors->has('order_total'))
                                    <span class="text-danger">{{ $errors->first('order_total') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_price">{{ trans('cruds.order.fields.total_price') }}</label>
                                <input class="form-control {{ $errors->has('total_price') ? 'is-invalid' : '' }}" type="number" name="total_price" id="total_price" value="{{ old('total_price', $order->total_price) }}" step="0.01">
                                @if($errors->has('total_price'))
                                    <span class="text-danger">{{ $errors->first('total_price') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
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