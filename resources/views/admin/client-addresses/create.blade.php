@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} Client Address
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.client-addresses.store") }}" enctype="multipart/form-data">
            @csrf

            {{-- Display Options --}}
            <div class="card card-outline card-secondary mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-cog mr-1"></i> Address Options</h6>
                </div>
                <div class="card-body py-2">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <div class="icheck-success">
                                <input type="hidden" name="is_primary" value="0">
                                <input type="checkbox" name="is_primary" id="is_primary" value="1" {{ old('is_primary', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_primary">Primary Address</label>
                            </div>
                            <small class="text-muted">Default for this type</small>
                        </div>
                        <div class="col-md-3">
                            <div class="icheck-warning">
                                <input type="hidden" name="is_fake" value="0">
                                <input type="checkbox" name="is_fake" id="is_fake" value="1" {{ old('is_fake', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_fake">Fake/Demo</label>
                            </div>
                            <small class="text-muted">Test data only</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="client_id">{{ trans('cruds.clientAddress.fields.client') }}</label>
                    <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                        @foreach($clients as $id => $entry)
                            <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('client'))
                        <span class="text-danger">{{ $errors->first('client') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.clientAddress.fields.client_helper') }}</span>
                </div>
                <div class="col-md-4 form-group">
                    <label>{{ trans('cruds.clientAddress.fields.address_type') }}</label>
                    <select class="form-control {{ $errors->has('address_type') ? 'is-invalid' : '' }}" name="address_type" id="address_type">
                        <option value disabled {{ old('address_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\ClientAddress::ADDRESS_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('address_type', 'location') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('address_type'))
                        <span class="text-danger">{{ $errors->first('address_type') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.clientAddress.fields.address_type_helper') }}</span>
                </div>


            </div>
            {{-- Top Row: Client, Type, Label, Nickname --}}
            <div class="row mb-3">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" type="text" name="label" id="label" value="{{ old('label', '') }}" placeholder="Main Office">
                        @if($errors->has('label'))
                            <span class="text-danger">{{ $errors->first('label') }}</span>
                        @endif
                        <span class="help-block">e.g., Store #123</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nickname">Nickname</label>
                        <input class="form-control {{ $errors->has('nickname') ? 'is-invalid' : '' }}" type="text" name="nickname" id="nickname" value="{{ old('nickname', '') }}" placeholder="Friendly name">
                        @if($errors->has('nickname'))
                            <span class="text-danger">{{ $errors->first('nickname') }}</span>
                        @endif
                        <span class="help-block">Short reference name</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address_line_1">Address Line 1 <span class="text-danger">*</span></label>
                        <input class="form-control {{ $errors->has('address_line_1') ? 'is-invalid' : '' }}" type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1', '') }}" required>
                        @if($errors->has('address_line_1'))
                            <span class="text-danger">{{ $errors->first('address_line_1') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address_line_2">Address Line 2</label>
                        <input class="form-control {{ $errors->has('address_line_2') ? 'is-invalid' : '' }}" type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', '') }}">
                        @if($errors->has('address_line_2'))
                            <span class="text-danger">{{ $errors->first('address_line_2') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">City <span class="text-danger">*</span></label>
                        <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                        @if($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="state">State <span class="text-danger">*</span></label>
                        <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}" required>
                        @if($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="postal_code">Postal Code <span class="text-danger">*</span></label>
                        <input class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}" type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', '') }}" required>
                        @if($errors->has('postal_code'))
                            <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', 'USA') }}">
                        @if($errors->has('country'))
                            <span class="text-danger">{{ $errors->first('country') }}</span>
                        @endif
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

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="delivery_notes">Delivery Notes</label>
                        <textarea class="form-control {{ $errors->has('delivery_notes') ? 'is-invalid' : '' }}" name="delivery_notes" id="delivery_notes" rows="3">{{ old('delivery_notes', '') }}</textarea>
                        @if($errors->has('delivery_notes'))
                            <span class="text-danger">{{ $errors->first('delivery_notes') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="special_instructions">Special Instructions</label>
                        <textarea class="form-control {{ $errors->has('special_instructions') ? 'is-invalid' : '' }}" name="special_instructions" id="special_instructions" rows="3">{{ old('special_instructions', '') }}</textarea>
                        @if($errors->has('special_instructions'))
                            <span class="text-danger">{{ $errors->first('special_instructions') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="google_map_link">Google Map Link</label>
                <input class="form-control {{ $errors->has('google_map_link') ? 'is-invalid' : '' }}" type="url" name="google_map_link" id="google_map_link" value="{{ old('google_map_link', '') }}" placeholder="https://maps.google.com/...">
                @if($errors->has('google_map_link'))
                    <span class="text-danger">{{ $errors->first('google_map_link') }}</span>
                @endif
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
