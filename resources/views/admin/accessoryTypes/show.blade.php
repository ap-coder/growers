@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Accessory Type
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accessory-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $accessoryType->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $accessoryType->name }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $accessoryType->description }}</td>
                    </tr>
                    <tr>
                        <th>Published</th>
                        <td><input type="checkbox" disabled {{ $accessoryType->published ? 'checked' : '' }}></td>
                    </tr>
                    <tr>
                        <th>Sort Order</th>
                        <td>{{ $accessoryType->sort_order }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accessory-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Accessories in this Type
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Base Price</th>
                        <th>Published</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accessoryType->accessories as $accessory)
                        <tr>
                            <td>{{ $accessory->id }}</td>
                            <td>
                                <a href="{{ route('admin.accessories.show', $accessory->id) }}">
                                    {{ $accessory->name }}
                                </a>
                            </td>
                            <td>{{ $accessory->sku }}</td>
                            <td>{{ $accessory->base_price ? '$' . number_format($accessory->base_price, 2) : '-' }}</td>
                            <td><input type="checkbox" disabled {{ $accessory->published ? 'checked' : '' }}></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
