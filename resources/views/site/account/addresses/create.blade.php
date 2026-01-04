@extends('site.layouts.app')

@section('title', 'Add Address - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.dashboard') }}">Account</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.addresses') }}">Addresses</a></li>
                    <li class="breadcrumb-item">Add Address</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-inner-1">
    <div class="container">
        <div class="row">
            @include('site.layouts.partials.account-sidebar')
            
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="title mb-4">Add New Address</h4>
                    
                    <form action="{{ route('site.account.addresses.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="address_type" class="form-label">Address Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('address_type') is-invalid @enderror" id="address_type" name="address_type" required>
                                    <option value="">Select Type</option>
                                    @foreach($addressTypes as $value => $label)
                                    <option value="{{ $value }}" {{ old('address_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('address_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="label" class="form-label">Address Label</label>
                                <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{ old('label') }}" placeholder="e.g., Main Warehouse, Store #123">
                                @error('label')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="nickname" class="form-label">Nickname</label>
                                <input type="text" class="form-control @error('nickname') is-invalid @enderror" id="nickname" name="nickname" value="{{ old('nickname') }}" placeholder="Friendly name">
                                @error('nickname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        <h5 class="mb-3">Address</h5>
                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="address_line_1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('address_line_1') is-invalid @enderror" id="address_line_1" name="address_line_1" value="{{ old('address_line_1') }}" required>
                                @error('address_line_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="address_line_2" class="form-label">Address Line 2</label>
                                <input type="text" class="form-control @error('address_line_2') is-invalid @enderror" id="address_line_2" name="address_line_2" value="{{ old('address_line_2') }}">
                                @error('address_line_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
                                @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state') }}" required>
                                @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="postal_code" class="form-label">ZIP Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
                                @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        <h5 class="mb-3">Contact Information (Optional)</h5>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="contact_name" class="form-label">Contact Name</label>
                                <input type="text" class="form-control @error('contact_name') is-invalid @enderror" id="contact_name" name="contact_name" value="{{ old('contact_name') }}">
                                @error('contact_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="contact_phone" class="form-label">Contact Phone</label>
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}">
                                @error('contact_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="contact_email" class="form-label">Contact Email</label>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" name="contact_email" value="{{ old('contact_email') }}">
                                @error('contact_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="delivery_notes" class="form-label">Delivery Notes</label>
                                <textarea class="form-control @error('delivery_notes') is-invalid @enderror" id="delivery_notes" name="delivery_notes" rows="3" placeholder="Special instructions for deliveries...">{{ old('delivery_notes') }}</textarea>
                                @error('delivery_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="google_map_link" class="form-label">Google Map Link</label>
                                <input type="url" class="form-control @error('google_map_link') is-invalid @enderror" id="google_map_link" name="google_map_link" value="{{ old('google_map_link') }}" placeholder="https://maps.google.com/...">
                                @error('google_map_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="is_primary" name="is_primary" value="1" {{ old('is_primary') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_primary">
                                Set as primary address for this type
                            </label>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Add Address</button>
                            <a href="{{ route('site.account.addresses') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
