<div class="form-group">
    <label>Section Title</label>
    <input type="text" name="title" class="form-control" value="{{ $section->title }}">
</div>
<div class="form-group">
    <label>Contact Information</label>
    <textarea name="content" class="form-control" rows="4">{{ $section->content }}</textarea>
    <small class="text-muted">Address, phone, email, etc.</small>
</div>
