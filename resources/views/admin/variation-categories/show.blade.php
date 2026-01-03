@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <i class="fas fa-eye mr-1"></i> View Variation Category
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('admin.variation-categories.index') }}">
                    <i class="fas fa-arrow-left mr-1"></i> Back to List
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $variationCategory->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $variationCategory->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $variationCategory->slug }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $variationCategory->description }}</td>
                    </tr>
                    <tr>
                        <th>Sort Order</th>
                        <td>{{ $variationCategory->sort_order }}</td>
                    </tr>
                    <tr>
                        <th>Published</th>
                        <td>
                            @if($variationCategory->published)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-secondary">No</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Variations Using This Category</th>
                        <td>{{ $variationCategory->variations->count() }}</td>
                    </tr>
                </tbody>
            </table>

            @if($variationCategory->variations->count() > 0)
            <h5 class="mt-4">Variations</h5>
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Variation Name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($variationCategory->variations as $variation)
                    <tr>
                        <td>{{ $variation->product->name ?? 'N/A' }}</td>
                        <td>{{ $variation->name }}</td>
                        <td>${{ number_format($variation->base_price ?? 0, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <div class="form-group mt-3">
                <a class="btn btn-secondary" href="{{ route('admin.variation-categories.index') }}">
                    <i class="fas fa-arrow-left mr-1"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
