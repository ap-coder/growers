<div class="form-group">
    <label>Section Title</label>
    <input type="text" name="title" class="form-control" value="{{ $section->title }}">
</div>
<div class="form-group">
    <label>Category IDs (comma-separated)</label>
    <input type="text" name="content" class="form-control" value="{{ $section->content }}" placeholder="1,2,3,4">
    <small class="text-muted">Enter category IDs to display, or leave empty to show all categories</small>
</div>
