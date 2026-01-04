@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} Client Address
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.client-addresses.update", [$clientAddress->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            
            <div class="form-group">
                <label for="client_id">Client <span class="text-danger">*</span></label>
                <select class="form-control select2 {{ $errors->has('client_id') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $clientAddress->client_id) == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_id'))
                    <span class="text-danger">{{ $errors->first('client_id') }}</span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="address_type">Address Type <span class="text-danger">*</span></label>
                        <select class="form-control select2 {{ $errors->has('address_type') ? 'is-invalid' : '' }}" name="address_type" id="address_type" required>
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($addressTypes as $key => $label)
                                <option value="{{ $key }}" {{ (old('address_type') ? old('address_type') : $clientAddress->address_type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('address_type'))
                            <span class="text-danger">{{ $errors->first('address_type') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" type="text" name="label" id="label" value="{{ old('label', $clientAddress->label) }}" placeholder="e.g., Main Office, Store #123">
                        @if($errors->has('label'))
                            <span class="text-danger">{{ $errors->first('label') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nickname">Nickname</label>
                        <input class="form-control {{ $errors->has('nickname') ? 'is-invalid' : '' }}" type="text" name="nickname" id="nickname" value="{{ old('nickname', $clientAddress->nickname) }}" placeholder="Friendly name">
                        @if($errors->has('nickname'))
                            <span class="text-danger">{{ $errors->first('nickname') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address_line_1">Address Line 1 <span class="text-danger">*</span></label>
                        <input class="form-control {{ $errors->has('address_line_1') ? 'is-invalid' : '' }}" type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1', $clientAddress->address_line_1) }}" required>
                        @if($errors->has('address_line_1'))
                            <span class="text-danger">{{ $errors->first('address_line_1') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address_line_2">Address Line 2</label>
                        <input class="form-control {{ $errors->has('address_line_2') ? 'is-invalid' : '' }}" type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $clientAddress->address_line_2) }}">
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
                        <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $clientAddress->city) }}" required>
                        @if($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="state">State <span class="text-danger">*</span></label>
                        <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $clientAddress->state) }}" required>
                        @if($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="postal_code">Postal Code <span class="text-danger">*</span></label>
                        <input class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}" type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $clientAddress->postal_code) }}" required>
                        @if($errors->has('postal_code'))
                            <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', $clientAddress->country) }}">
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
                        <input class="form-control {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $clientAddress->contact_name) }}">
                        @if($errors->has('contact_name'))
                            <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_phone">Contact Phone</label>
                        <input class="form-control {{ $errors->has('contact_phone') ? 'is-invalid' : '' }}" type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $clientAddress->contact_phone) }}">
                        @if($errors->has('contact_phone'))
                            <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_email">Contact Email</label>
                        <input class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $clientAddress->contact_email) }}">
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
                        <textarea class="form-control {{ $errors->has('delivery_notes') ? 'is-invalid' : '' }}" name="delivery_notes" id="delivery_notes" rows="3">{{ old('delivery_notes', $clientAddress->delivery_notes) }}</textarea>
                        @if($errors->has('delivery_notes'))
                            <span class="text-danger">{{ $errors->first('delivery_notes') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="special_instructions">Special Instructions</label>
                        <textarea class="form-control {{ $errors->has('special_instructions') ? 'is-invalid' : '' }}" name="special_instructions" id="special_instructions" rows="3">{{ old('special_instructions', $clientAddress->special_instructions) }}</textarea>
                        @if($errors->has('special_instructions'))
                            <span class="text-danger">{{ $errors->first('special_instructions') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="google_map_link">Google Map Link</label>
                <input class="form-control {{ $errors->has('google_map_link') ? 'is-invalid' : '' }}" type="url" name="google_map_link" id="google_map_link" value="{{ old('google_map_link', $clientAddress->google_map_link) }}" placeholder="https://maps.google.com/...">
                @if($errors->has('google_map_link'))
                    <span class="text-danger">{{ $errors->first('google_map_link') }}</span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check {{ $errors->has('is_primary') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="is_primary" value="0">
                            <input class="form-check-input" type="checkbox" name="is_primary" id="is_primary" value="1" {{ old('is_primary', $clientAddress->is_primary) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_primary">
                                Set as Primary Address
                            </label>
                        </div>
                        @if($errors->has('is_primary'))
                            <span class="text-danger">{{ $errors->first('is_primary') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check {{ $errors->has('is_fake') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="is_fake" value="0">
                            <input class="form-check-input" type="checkbox" name="is_fake" id="is_fake" value="1" {{ old('is_fake', $clientAddress->is_fake) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_fake">
                                Mark as Fake/Demo Address
                            </label>
                        </div>
                        @if($errors->has('is_fake'))
                            <span class="text-danger">{{ $errors->first('is_fake') }}</span>
                        @endif
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
