<div class="form-group">
    <label for="categories">Categories</label>
    <select name="categories[]" id="categories" class="form-control select2" multiple="multiple" data-placeholder="Select Categories" style="width: 100%;">
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ (in_array($category->id, old('categories', [])) || $product->categories->contains($category->id)) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

