<div class="form-group">
    <label>Section Title</label>
    <input type="text" name="title" class="form-control" value="{{ $section->title }}">
</div>
<div class="form-group">
    <label>FAQ Items (JSON format)</label>
    <textarea name="content" class="form-control" rows="8" placeholder='[{"question": "What is...?", "answer": "It is..."}]'>{{ $section->content }}</textarea>
    <small class="text-muted">Enter FAQ items as JSON array with question and answer for each</small>
</div>
