<div class="section-item" data-id="{{ $section->id }}">
    <div class="section-header">
        <div class="d-flex align-items-center">
            <span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>
            <div>
                <span class="section-title-text">{{ $section->title ?: 'Untitled' }}</span>
                <span class="section-type badge badge-secondary ml-2">{{ \App\Models\PageSection::SECTION_TYPES[$section->section_type]['label'] ?? $section->section_type }}</span>
            </div>
        </div>
        <div class="section-actions">
            <button type="button" class="btn btn-sm btn-outline-secondary section-toggle">
                <i class="fas fa-chevron-down"></i>
            </button>
            <button type="button" class="btn btn-sm btn-outline-danger delete-section-btn">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    <div class="section-body">
        <form class="section-form">
            @include('admin.contentPages.partials.section-fields.' . $section->section_type, ['section' => $section])
            
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Alignment</label>
                        <select name="alignment" class="form-control form-control-sm">
                            @foreach(\App\Models\PageSection::ALIGNMENTS as $key => $label)
                                <option value="{{ $key }}" {{ $section->alignment == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Container Width</label>
                        <select name="container_width" class="form-control form-control-sm">
                            @foreach(\App\Models\PageSection::CONTAINER_WIDTHS as $key => $label)
                                <option value="{{ $key }}" {{ $section->container_width == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Padding</label>
                        <select name="padding" class="form-control form-control-sm">
                            @foreach(\App\Models\PageSection::PADDINGS as $key => $label)
                                <option value="{{ $key }}" {{ $section->padding == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Background Color</label>
                        <input type="text" name="background_color" class="form-control form-control-sm" value="{{ $section->background_color }}" placeholder="#ffffff or bg-light">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Text Color</label>
                        <input type="text" name="text_color" class="form-control form-control-sm" value="{{ $section->text_color }}" placeholder="#000000 or text-white">
                    </div>
                </div>
            </div>
            <div class="form-group mb-0">
                <button type="button" class="btn btn-primary save-section-btn">
                    <i class="fas fa-save mr-1"></i> Save Section
                </button>
            </div>
        </form>
    </div>
</div>
