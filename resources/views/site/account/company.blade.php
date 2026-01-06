@extends('site.layouts.app')

@section('title', 'Company Info - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.dashboard') }}">Account</a></li>
                    <li class="breadcrumb-item">Company Info</li>
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
                    <h4 class="title mb-4">Company Information</h4>
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    <form action="{{ route('site.account.company.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $client->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="store_number" class="form-label">Store/Account Number</label>
                                <input type="text" class="form-control @error('store_number') is-invalid @enderror" id="store_number" name="store_number" value="{{ old('store_number', $client->store_number) }}">
                                @error('store_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $client->address) }}</textarea>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="logo" class="form-label">Company Logo</label>
                                <div class="needsclick dropzone @error('logo') is-invalid @enderror" id="logo-dropzone"></div>
                                @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Upload a new logo to replace the current one. Images will be automatically converted to WebP format.</small>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        <h5 class="mb-3">Primary Contact</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact_name" class="form-label">Contact Name</label>
                                <input type="text" class="form-control @error('contact_name') is-invalid @enderror" id="contact_name" name="contact_name" value="{{ old('contact_name', $client->contact_name) }}">
                                @error('contact_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="contact_phone" class="form-label">Contact Phone</label>
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $client->contact_phone) }}">
                                @error('contact_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="contact_email" class="form-label">Contact Email</label>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" name="contact_email" value="{{ old('contact_email', $client->contact_email) }}">
                                @error('contact_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Dropzone configuration for company logo upload
var uploadedLogoMap = {};
Dropzone.options.logoDropzone = {
    url: '{{ route('site.account.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
        size: 2
    },
    success: function (file, response) {
        $('form').append('<input type="hidden" name="logo" value="' + response.name + '">');
        uploadedLogoMap[file.name] = response.name;
    },
    removedfile: function (file) {
        file.previewElement.remove();
        var name = '';
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name;
        } else {
            name = uploadedLogoMap[file.name];
        }
        $('form').find('input[name="logo"][value="' + name + '"]').remove();
    },
    init: function () {
        @if($client->logo)
            var file = {!! json_encode($client->logo) !!};
            this.options.addedfile.call(this, file);
            this.options.thumbnail.call(this, file, file.url);
            file.previewElement.classList.add('dz-complete');
            $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">');
        @endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response;
        } else {
            var message = response.errors.file;
        }
        file.previewElement.classList.add('dz-error');
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]');
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    }
};
</script>
@endsection
