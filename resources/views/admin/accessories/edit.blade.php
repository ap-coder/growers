@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} Accessory
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.accessories.update", [$accessory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="accessory_type_id">Accessory Type</label>
                <select class="form-control select2 {{ $errors->has('accessory_type') ? 'is-invalid' : '' }}" name="accessory_type_id" id="accessory_type_id" required>
                    @foreach($accessoryTypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('accessory_type_id', $accessory->accessory_type_id) == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('accessory_type'))
                    <span class="text-danger">{{ $errors->first('accessory_type') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $accessory->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $accessory->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="sku">SKU</label>
                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text" name="sku" id="sku" value="{{ old('sku', $accessory->sku) }}">
                @if($errors->has('sku'))
                    <span class="text-danger">{{ $errors->first('sku') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="base_price">Base Price</label>
                <input class="form-control {{ $errors->has('base_price') ? 'is-invalid' : '' }}" type="number" name="base_price" id="base_price" value="{{ old('base_price', $accessory->base_price) }}" step="0.01">
                @if($errors->has('base_price'))
                    <span class="text-danger">{{ $errors->first('base_price') }}</span>
                @endif
                <span class="help-block">Default price if no client-specific price is set</span>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', $accessory->published) ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">Published</label>
                </div>
            </div>
            <div class="form-group">
                <label for="sort_order">Sort Order</label>
                <input class="form-control {{ $errors->has('sort_order') ? 'is-invalid' : '' }}" type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $accessory->sort_order) }}">
                @if($errors->has('sort_order'))
                    <span class="text-danger">{{ $errors->first('sort_order') }}</span>
                @endif
            </div>
        </form>
    </div>
</div>

@if($clients->count() > 0)
<div class="card">
    <div class="card-header">
        Client-Specific Pricing
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.accessories.update", [$accessory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="accessory_type_id" value="{{ $accessory->accessory_type_id }}">
            <input type="hidden" name="name" value="{{ $accessory->name }}">
            <input type="hidden" name="base_price" value="{{ $accessory->base_price }}">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            @php
                                $clientPrice = $accessory->clientPrices->where('client_id', $client->id)->first();
                            @endphp
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>
                                    <input class="form-control" type="number" step="0.01" 
                                        name="client_prices[{{ $client->id }}][price]" 
                                        value="{{ old('client_prices.' . $client->id . '.price', $clientPrice->price ?? '') }}"
                                        placeholder="Use base price">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endif

@endsection
