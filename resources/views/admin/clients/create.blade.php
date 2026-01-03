@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clients.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 || old('published') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">{{ trans('cruds.client.fields.published') }}</label>
                </div>
                @if($errors->has('published'))
                    <span class="text-danger">{{ $errors->first('published') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.published_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.client.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">Client Logo</label>
                <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}" type="file" name="logo" id="logo" accept="image/*">
                @if($errors->has('logo'))
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                @endif
                <span class="help-block">Upload client logo for packing slips and order documents</span>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="store_number">Store Number</label>
                        <input class="form-control {{ $errors->has('store_number') ? 'is-invalid' : '' }}" type="text" name="store_number" id="store_number" value="{{ old('store_number', '') }}">
                        @if($errors->has('store_number'))
                            <span class="text-danger">{{ $errors->first('store_number') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check mt-4">
                            <input type="hidden" name="requires_upc" value="0">
                            <input class="form-check-input" type="checkbox" name="requires_upc" id="requires_upc" value="1" {{ old('requires_upc', 0) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="requires_upc">Requires UPC Codes</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_name">Contact Name</label>
                        <input class="form-control {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', '') }}">
                        @if($errors->has('contact_name'))
                            <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_phone">Contact Phone</label>
                        <input class="form-control {{ $errors->has('contact_phone') ? 'is-invalid' : '' }}" type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', '') }}">
                        @if($errors->has('contact_phone'))
                            <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_email">Contact Email</label>
                        <input class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', '') }}">
                        @if($errors->has('contact_email'))
                            <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @php $client = new \App\Models\Client(); @endphp
            @include('admin.clients.partials.addresses')
            <div class="form-group">
                <label for="delivery_notes">Delivery Notes</label>
                <textarea class="form-control {{ $errors->has('delivery_notes') ? 'is-invalid' : '' }}" name="delivery_notes" id="delivery_notes" rows="3">{{ old('delivery_notes') }}</textarea>
                @if($errors->has('delivery_notes'))
                    <span class="text-danger">{{ $errors->first('delivery_notes') }}</span>
                @endif
                <span class="help-block">Special delivery instructions for this client</span>
            </div>
            <div class="form-group">
                <label for="how_to_order_content">How to Order Content (Client-Specific)</label>
                <textarea class="form-control ckeditor {{ $errors->has('how_to_order_content') ? 'is-invalid' : '' }}" name="how_to_order_content" id="how_to_order_content" rows="8">{{ old('how_to_order_content') }}</textarea>
                @if($errors->has('how_to_order_content'))
                    <span class="text-danger">{{ $errors->first('how_to_order_content') }}</span>
                @endif
                <span class="help-block">Custom "How to Order" content for this client. Leave blank to use the default content.</span>
            </div>
            <div class="form-group">
                <label for="prices_id">{{ trans('cruds.client.fields.prices') }}</label>
                <select class="form-control select2 {{ $errors->has('prices') ? 'is-invalid' : '' }}" name="prices_id" id="prices_id">
                    @foreach($prices as $id => $entry)
                        <option value="{{ $id }}" {{ old('prices_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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