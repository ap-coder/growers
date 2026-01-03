{{-- Media Tab --}}
@php
    $currentLayout = old('layout', $product->layout ?? 'default');
    $layoutImageHelp = [
        'default' => [
            'main' => 'Main image shown in shop cards (300x300) and as the primary product image (600x600).',
            'additional' => 'Gallery images shown in the product detail carousel. First image becomes main if no main photo set.',
        ],
        'thumbnail' => [
            'main' => 'Large hero image displayed prominently at top of product page (600x600).',
            'additional' => 'Thumbnail gallery images shown below the main image (100x100 thumbnails, click to enlarge).',
        ],
        'gallery' => [
            'main' => 'Featured image for shop listings (300x300) and gallery header.',
            'additional' => 'Full gallery grid images. All images displayed equally in a responsive grid layout.',
        ],
        'simple' => [
            'main' => 'Single product image shown in listings (300x300) and detail page (600x600).',
            'additional' => 'Not displayed in simple layout - only main photo is used.',
        ],
    ];
    $mainHelp = $layoutImageHelp[$currentLayout]['main'] ?? $layoutImageHelp['default']['main'];
    $additionalHelp = $layoutImageHelp[$currentLayout]['additional'] ?? $layoutImageHelp['default']['additional'];
@endphp
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card card-primary h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-image mr-2"></i>Main Photo</h5>
            </div>
            <div class="card-body">
                <div class="needsclick dropzone" id="photo-dropzone"></div>
                <small class="text-muted d-block mt-2" id="main-photo-help">{{ $mainHelp }}</small>
                <small class="text-info d-block mt-1"><i class="fas fa-info-circle mr-1"></i>Recommended: 800x800px minimum, square aspect ratio. Auto-converted to WebP.</small>
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
                <small class="text-muted d-block mt-2" id="additional-photos-help">{{ $additionalHelp }}</small>
                <small class="text-info d-block mt-1"><i class="fas fa-info-circle mr-1"></i>Upload multiple images. Drag to reorder. Auto-converted to WebP.</small>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var layoutSelect = document.getElementById('layout');
    if (layoutSelect) {
        var layoutHelp = {
            'default': {
                main: 'Main image shown in shop cards (300x300) and as the primary product image (600x600).',
                additional: 'Gallery images shown in the product detail carousel. First image becomes main if no main photo set.'
            },
            'thumbnail': {
                main: 'Large hero image displayed prominently at top of product page (600x600).',
                additional: 'Thumbnail gallery images shown below the main image (100x100 thumbnails, click to enlarge).'
            },
            'gallery': {
                main: 'Featured image for shop listings (300x300) and gallery header.',
                additional: 'Full gallery grid images. All images displayed equally in a responsive grid layout.'
            },
            'simple': {
                main: 'Single product image shown in listings (300x300) and detail page (600x600).',
                additional: 'Not displayed in simple layout - only main photo is used.'
            }
        };
        
        layoutSelect.addEventListener('change', function() {
            var layout = this.value || 'default';
            var help = layoutHelp[layout] || layoutHelp['default'];
            var mainHelp = document.getElementById('main-photo-help');
            var additionalHelp = document.getElementById('additional-photos-help');
            if (mainHelp) mainHelp.textContent = help.main;
            if (additionalHelp) additionalHelp.textContent = help.additional;
        });
    }
});
</script>
