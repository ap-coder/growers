<div class="form-group">
    <label for="tags">Tags</label>
    <select name="tags[]" class="form-control select2" multiple="multiple">
        @foreach($tags as $id => $tag)
            <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $product->tags->contains($id)) ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>
</div>
