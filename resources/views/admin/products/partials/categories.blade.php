<div class="form-group">
    <label for="categories">Categories</label>
    <select name="categories[]" class="form-control select2" style="width: 100%;" multiple="multiple" id="categories">
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ (in_array($category->id, old('categories', [])) || $product->categories->contains($category->id)) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
        Add New Category
    </button>
</div>


@include('admin.products.partials.add-category-modal')
