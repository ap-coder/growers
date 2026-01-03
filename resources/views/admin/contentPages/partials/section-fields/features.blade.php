<div class="form-group">
    <label>Section Title</label>
    <input type="text" name="title" class="form-control" value="{{ $section->title }}">
</div>
<div class="form-group">
    <label>Features (JSON format)</label>
    <textarea name="content" class="form-control" rows="8" placeholder='[{"icon": "fas fa-leaf", "title": "Feature 1", "description": "Description here"}]'>{{ $section->content }}</textarea>
    <small class="text-muted">Enter features as JSON array with icon, title, and description for each</small>
</div>
