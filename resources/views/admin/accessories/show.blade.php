@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Accessory
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accessories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $accessory->id }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{ $accessory->accessoryType->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $accessory->name }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $accessory->description }}</td>
                    </tr>
                    <tr>
                        <th>SKU</th>
                        <td>{{ $accessory->sku }}</td>
                    </tr>
                    <tr>
                        <th>Base Price</th>
                        <td>{{ $accessory->base_price ? '$' . number_format($accessory->base_price, 2) : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Published</th>
                        <td><input type="checkbox" disabled {{ $accessory->published ? 'checked' : '' }}></td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accessories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@if($accessory->clientPrices->count() > 0)
<div class="card">
    <div class="card-header">
        Client-Specific Prices
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accessory->clientPrices as $clientPrice)
                        <tr>
                            <td>{{ $clientPrice->client->name ?? '' }}</td>
                            <td>${{ number_format($clientPrice->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@if($accessory->products->count() > 0)
<div class="card">
    <div class="card-header">
        Products Using This Accessory
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Default</th>
                        <th>Required</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accessory->products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('admin.products.show', $product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td><input type="checkbox" disabled {{ $product->pivot->is_default ? 'checked' : '' }}></td>
                            <td><input type="checkbox" disabled {{ $product->pivot->is_required ? 'checked' : '' }}></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@endsection
