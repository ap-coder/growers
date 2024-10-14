@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.clientPrice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-prices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.id') }}
                        </th>
                        <td>
                            {{ $clientPrice->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.product') }}
                        </th>
                        <td>
                            {{ $clientPrice->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.price') }}
                        </th>
                        <td>
                            {{ $clientPrice->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.sku') }}
                        </th>
                        <td>
                            {{ $clientPrice->sku }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.mpn') }}
                        </th>
                        <td>
                            {{ $clientPrice->mpn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.gtin') }}
                        </th>
                        <td>
                            {{ $clientPrice->gtin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.upc') }}
                        </th>
                        <td>
                            {{ $clientPrice->upc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.qb_1') }}
                        </th>
                        <td>
                            {{ $clientPrice->qb_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.qb_2') }}
                        </th>
                        <td>
                            {{ $clientPrice->qb_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.barcode_image') }}
                        </th>
                        <td>
                            @if($clientPrice->barcode_image)
                                <a href="{{ $clientPrice->barcode_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $clientPrice->barcode_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientPrice.fields.client') }}
                        </th>
                        <td>
                            {{ $clientPrice->client->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-prices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection