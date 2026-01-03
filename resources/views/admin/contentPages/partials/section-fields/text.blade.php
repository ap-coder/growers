<div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="{{ $section->title }}">
</div>
<div class="form-group">
    <label>Content</label>
    <textarea name="content" class="form-control" rows="6">{{ $section->content }}</textarea>
</div>
