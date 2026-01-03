<div class="form-group">
    <label>Divider Style</label>
    <select name="content" class="form-control">
        <option value="solid" {{ $section->content == 'solid' ? 'selected' : '' }}>Solid Line</option>
        <option value="dashed" {{ $section->content == 'dashed' ? 'selected' : '' }}>Dashed Line</option>
        <option value="dotted" {{ $section->content == 'dotted' ? 'selected' : '' }}>Dotted Line</option>
    </select>
</div>
