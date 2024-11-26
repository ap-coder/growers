<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Published</label>
            <select name="status" class="form-control">
                <option value="1" {{ $product->published == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $product->published == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <div class="form-group form-check mb-0">
            <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }}>
            <label class="form-check-label" for="featured">Featured</label>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
</div>

