<div class="form-group">
    <label for="status">Status</label>
    <select name="status" class="form-control">
        <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<div class="form-group">
    <label for="featured">Featured</label>
    <input type="checkbox" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }}>
</div>
