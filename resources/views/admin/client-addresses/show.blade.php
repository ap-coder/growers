@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Client Address
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-addresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id') }}
                        </th>
                        <td>
                            {{ $clientAddress->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Client
                        </th>
                        <td>
                            {{ $clientAddress->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Address Type
                        </th>
                        <td>
                            {{ \App\Models\ClientAddress::TYPE_SELECT[$clientAddress->address_type] ?? $clientAddress->address_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Label
                        </th>
                        <td>
                            {{ $clientAddress->label }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nickname
                        </th>
                        <td>
                            {{ $clientAddress->nickname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Full Address
                        </th>
                        <td>
                            {{ $clientAddress->full_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Contact Name
                        </th>
                        <td>
                            {{ $clientAddress->contact_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Contact Phone
                        </th>
                        <td>
                            {{ $clientAddress->contact_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Contact Email
                        </th>
                        <td>
                            {{ $clientAddress->contact_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Delivery Notes
                        </th>
                        <td>
                            {{ $clientAddress->delivery_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Special Instructions
                        </th>
                        <td>
                            {{ $clientAddress->special_instructions }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Google Map Link
                        </th>
                        <td>
                            @if($clientAddress->google_map_link)
                                <a href="{{ $clientAddress->google_map_link }}" target="_blank">{{ $clientAddress->google_map_link }}</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Primary
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $clientAddress->is_primary ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Fake/Demo
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $clientAddress->is_fake ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-addresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
