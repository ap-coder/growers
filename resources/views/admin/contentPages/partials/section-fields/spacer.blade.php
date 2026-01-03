<div class="form-group">
    <label>Spacer Height</label>
    <select name="content" class="form-control">
        <option value="small" {{ $section->content == 'small' ? 'selected' : '' }}>Small (30px)</option>
        <option value="medium" {{ $section->content == 'medium' ? 'selected' : '' }}>Medium (60px)</option>
        <option value="large" {{ $section->content == 'large' ? 'selected' : '' }}>Large (100px)</option>
    </select>
</div>
