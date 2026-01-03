{{-- Media Tab --}}
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card card-primary h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-image mr-2"></i>Main Photo</h5>
            </div>
            <div class="card-body">
                <div class="needsclick dropzone" id="photo-dropzone"></div>
                <small class="text-muted d-block mt-2">Primary product image displayed in listings and detail pages.</small>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card card-info h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-images mr-2"></i>Additional Photos</h5>
            </div>
            <div class="card-body">
                <div class="needsclick dropzone {{ $errors->has('additional_photos') ? 'is-invalid' : '' }}" id="additional_photos-dropzone"></div>
                @if($errors->has('additional_photos'))
                    <span class="text-danger">{{ $errors->first('additional_photos') }}</span>
                @endif
                <small class="text-muted d-block mt-2">Gallery images for product detail page carousel.</small>
            </div>
        </div>
    </div>
</div>
