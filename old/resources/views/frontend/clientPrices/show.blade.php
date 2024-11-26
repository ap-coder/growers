@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.clientPrice.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.client-prices.index') }}">
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
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.client-prices.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection