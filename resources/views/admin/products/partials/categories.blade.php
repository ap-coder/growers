<div class="form-group">
    <label for="categories">Categories</label>
    <select name="categories[]" class="form-control select2" multiple="multiple">
        @foreach($categories as $id => $category)
            <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $product->categories->contains($id)) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
