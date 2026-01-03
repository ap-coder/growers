@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <i class="fas fa-edit mr-1"></i> Edit Variation Category
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.variation-categories.update', [$variationCategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $variationCategory->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">Category name (e.g., Size, Color, Material)</span>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" rows="3">{{ old('description', $variationCategory->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="sort_order">Sort Order</label>
                <input class="form-control {{ $errors->has('sort_order') ? 'is-invalid' : '' }}" type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $variationCategory->sort_order) }}">
                @if($errors->has('sort_order'))
                    <span class="text-danger">{{ $errors->first('sort_order') }}</span>
                @endif
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', $variationCategory->published) ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">Published</label>
                </div>
                @if($errors->has('published'))
                    <span class="text-danger">{{ $errors->first('published') }}</span>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save mr-1"></i> Save
                </button>
                <a href="{{ route('admin.variation-categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Back to List
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
