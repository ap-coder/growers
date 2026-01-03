<div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="{{ $section->title }}">
</div>
<div class="form-group">
    <label>Subtitle/Description</label>
    <textarea name="content" class="form-control" rows="2">{{ $section->content }}</textarea>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Button Text</label>
            <input type="text" name="button_text" class="form-control" value="{{ $section->button_text }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Button URL</label>
            <input type="text" name="button_url" class="form-control" value="{{ $section->button_url }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Button Style</label>
            <select name="button_style" class="form-control">
                @foreach(\App\Models\PageSection::BUTTON_STYLES as $key => $label)
                    <option value="{{ $key }}" {{ $section->button_style == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
