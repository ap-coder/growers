@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clients.update", [$client->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ $client->published || old('published', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">{{ trans('cruds.client.fields.published') }}</label>
                </div>
                @if($errors->has('published'))
                    <span class="text-danger">{{ $errors->first('published') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.published_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.client.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $client->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">Client Logo</label>
                @if($client->logo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $client->logo) }}" alt="Client Logo" style="max-height: 100px;">
                    </div>
                @endif
                <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}" type="file" name="logo" id="logo" accept="image/*">
                @if($errors->has('logo'))
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                @endif
                <span class="help-block">Upload client logo for packing slips and order documents. Leave empty to keep current.</span>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="store_number">Store Number</label>
                        <input class="form-control {{ $errors->has('store_number') ? 'is-invalid' : '' }}" type="text" name="store_number" id="store_number" value="{{ old('store_number', $client->store_number) }}">
                        @if($errors->has('store_number'))
                            <span class="text-danger">{{ $errors->first('store_number') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check mt-4">
                            <input type="hidden" name="requires_upc" value="0">
                            <input class="form-check-input" type="checkbox" name="requires_upc" id="requires_upc" value="1" {{ $client->requires_upc || old('requires_upc', 0) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="requires_upc">Requires UPC Codes</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_name">Contact Name</label>
                        <input class="form-control {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $client->contact_name) }}">
                        @if($errors->has('contact_name'))
                            <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_phone">Contact Phone</label>
                        <input class="form-control {{ $errors->has('contact_phone') ? 'is-invalid' : '' }}" type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $client->contact_phone) }}">
                        @if($errors->has('contact_phone'))
                            <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_email">Contact Email</label>
                        <input class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $client->contact_email) }}">
                        @if($errors->has('contact_email'))
                            <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @include('admin.clients.partials.addresses')
            @include('admin.clients.partials.users')
            <div class="form-group">
                <label for="prices_id">{{ trans('cruds.client.fields.prices') }}</label>
                <select class="form-control select2 {{ $errors->has('prices') ? 'is-invalid' : '' }}" name="prices_id" id="prices_id">
                    @foreach($prices as $id => $entry)
                        <option value="{{ $id }}" {{ (old('prices_id') ? old('prices_id') : $client->prices->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('prices'))
                    <span class="text-danger">{{ $errors->first('prices') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.prices_helper') }}</span>
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