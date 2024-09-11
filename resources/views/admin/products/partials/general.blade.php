<div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
</div>
