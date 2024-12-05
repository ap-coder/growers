<div class="form-group">
    <label for="categories">{{ trans('cruds.product.fields.category') }}</label>
    <div class="input-group">
        <select style="width: 90%; border-radius:0;" class="form-control select2" name="categories[]" id="categories" multiple>
            @foreach($categories as $id => $name)
                <option value="{{ $id }}" {{ in_array($id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="addCategory">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    @if($errors->has('categories'))
        <div class="invalid-feedback"> {{ $errors->first('categories') }} </div>
    @endif
    <span class="help-block">Select category or add new one then select it.</span>
</div>
