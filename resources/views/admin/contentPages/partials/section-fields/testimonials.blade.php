<div class="form-group">
    <label>Section Title</label>
    <input type="text" name="title" class="form-control" value="{{ $section->title }}">
</div>
<div class="form-group">
    <label>Testimonials (JSON format)</label>
    <textarea name="content" class="form-control" rows="8" placeholder='[{"name": "John Doe", "company": "ABC Corp", "quote": "Great service!"}]'>{{ $section->content }}</textarea>
    <small class="text-muted">Enter testimonials as JSON array with name, company, and quote for each</small>
</div>
