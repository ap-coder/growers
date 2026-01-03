<div class="page-builder">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-secondary">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-layer-group mr-2"></i>Page Sections</h5>
                </div>
                <div class="card-body p-0">
                    <div id="sections-list" class="sections-sortable">
                        @forelse($contentPage->sections as $section)
                            @include('admin.contentPages.partials.section-item', ['section' => $section])
                        @empty
                            <div class="text-center py-5 text-muted" id="no-sections-message">
                                <i class="fas fa-layer-group fa-3x mb-3"></i>
                                <p>No sections added yet.<br>Click "Add Section" to start building your page.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary sticky-top" style="top: 70px;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-plus mr-2"></i>Add Section</h5>
                </div>
                <div class="card-body">
                    <div class="section-types-grid">
                        @foreach(\App\Models\PageSection::SECTION_TYPES as $type => $info)
                            <button type="button" class="btn btn-outline-secondary btn-block text-left mb-2 add-section-btn" 
                                    data-type="{{ $type }}" 
                                    data-page-id="{{ $contentPage->id }}">
                                <i class="{{ $info['icon'] }} mr-2"></i>
                                <span>{{ $info['label'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.page-builder .section-item {
    border: 1px solid #dee2e6;
    border-radius: 4px;
    margin-bottom: 10px;
    background: #fff;
}
.page-builder .section-item .section-header {
    padding: 10px 15px;
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    cursor: move;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.page-builder .section-item .section-header .section-title {
    font-weight: 600;
    margin: 0;
}
.page-builder .section-item .section-header .section-type {
    font-size: 0.8rem;
    color: #6c757d;
}
.page-builder .section-item .section-body {
    padding: 15px;
    display: none;
}
.page-builder .section-item.open .section-body {
    display: block;
}
.page-builder .section-item .section-actions {
    display: flex;
    gap: 5px;
}
.page-builder .section-types-grid .btn {
    font-size: 0.85rem;
}
.page-builder .drag-handle {
    cursor: move;
    color: #adb5bd;
    margin-right: 10px;
}
.sections-sortable .ui-sortable-placeholder {
    border: 2px dashed #007bff;
    background: #e7f1ff;
    height: 60px;
    margin-bottom: 10px;
    border-radius: 4px;
}
</style>

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
$(function() {
    // Make sections sortable
    $('#sections-list').sortable({
        handle: '.drag-handle',
        placeholder: 'ui-sortable-placeholder',
        update: function(event, ui) {
            var order = [];
            $('#sections-list .section-item').each(function(index) {
                order.push({
                    id: $(this).data('id'),
                    sort_order: index
                });
            });
            
            $.ajax({
                url: '{{ route("admin.page-sections.reorder") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order: order
                },
                success: function(response) {
                    toastr.success('Section order updated');
                },
                error: function() {
                    toastr.error('Failed to update order');
                }
            });
        }
    });
    
    // Toggle section body
    $(document).on('click', '.section-toggle', function() {
        $(this).closest('.section-item').toggleClass('open');
        var icon = $(this).find('i');
        icon.toggleClass('fa-chevron-down fa-chevron-up');
    });
    
    // Add section
    $('.add-section-btn').on('click', function() {
        var type = $(this).data('type');
        var pageId = $(this).data('page-id');
        
        $.ajax({
            url: '{{ route("admin.page-sections.store") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                content_page_id: pageId,
                section_type: type
            },
            success: function(response) {
                $('#no-sections-message').remove();
                $('#sections-list').append(response.html);
                toastr.success('Section added');
            },
            error: function(xhr) {
                toastr.error('Failed to add section');
            }
        });
    });
    
    // Delete section
    $(document).on('click', '.delete-section-btn', function() {
        if (!confirm('Are you sure you want to delete this section?')) return;
        
        var sectionItem = $(this).closest('.section-item');
        var sectionId = sectionItem.data('id');
        
        $.ajax({
            url: '/admin/page-sections/' + sectionId,
            method: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function() {
                sectionItem.fadeOut(300, function() { $(this).remove(); });
                toastr.success('Section deleted');
            },
            error: function() {
                toastr.error('Failed to delete section');
            }
        });
    });
    
    // Save section
    $(document).on('click', '.save-section-btn', function() {
        var sectionItem = $(this).closest('.section-item');
        var sectionId = sectionItem.data('id');
        var form = sectionItem.find('.section-form');
        var formData = form.serialize();
        
        $.ajax({
            url: '/admin/page-sections/' + sectionId,
            method: 'PUT',
            data: formData + '&_token={{ csrf_token() }}',
            success: function(response) {
                sectionItem.find('.section-title-text').text(response.title || 'Untitled');
                toastr.success('Section saved');
            },
            error: function() {
                toastr.error('Failed to save section');
            }
        });
    });
});
</script>
@endpush
