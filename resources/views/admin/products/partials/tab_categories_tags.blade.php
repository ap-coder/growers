{{-- Categories & Tags Tab --}}
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-folder mr-2"></i>Categories</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-0">
                    <select class="form-control select2" name="categories[]" id="categories" multiple style="width: 100%;">
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}" {{ in_array($id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <button class="btn btn-outline-secondary btn-sm" type="button" id="addCategory">
                            <i class="fas fa-plus mr-1"></i> Add Category
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card card-info h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tags mr-2"></i>Tags</h5>
            </div>
            <div class="card-body">
                <div class="form-group mb-0">
                    <select class="form-control select2" name="tags[]" id="tags" multiple style="width: 100%;">
                        @foreach($tags ?? [] as $id => $name)
                            <option value="{{ $id }}" {{ in_array($id, old('tags', $product->tags->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <button class="btn btn-outline-secondary btn-sm" type="button" id="addTag">
                            <i class="fas fa-plus mr-1"></i> Add Tag
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
