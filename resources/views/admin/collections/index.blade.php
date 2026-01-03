@extends('layouts.admin')
@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.product-collections.create') }}">
            <i class="fas fa-plus"></i> Create Collection
        </a>
    </div>
</div>

@if(session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-layer-group mr-2"></i> Product Collections</h5>
    </div>
    <div class="card-body">
        @if($collections->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">Order</th>
                            <th>Name</th>
                            <th>Layout</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Homepage</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($collections as $collection)
                            <tr>
                                <td class="text-center">{{ $collection->sort_order }}</td>
                                <td>
                                    <strong>{{ $collection->name }}</strong>
                                    <br><small class="text-muted">{{ $collection->slug }}</small>
                                </td>
                                <td>
                                    <img src="{{ asset('site/images/portfolio/icons/' . $collection->layout_icon) }}" 
                                         alt="{{ $collection->layout_name }}" 
                                         style="height: 30px; margin-right: 8px;">
                                    {{ $collection->layout_name }}
                                </td>
                                <td>{{ $collection->products->count() }} products</td>
                                <td>
                                    @if($collection->published)
                                        <span class="badge badge-success">Published</span>
                                    @else
                                        <span class="badge badge-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    @if($collection->show_on_homepage)
                                        <span class="badge badge-info">Yes</span>
                                    @else
                                        <span class="badge badge-light">No</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.product-collections.edit', $collection) }}" class="btn btn-xs btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.product-collections.destroy', $collection) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-layer-group fa-3x text-muted mb-3"></i>
                <p class="text-muted">No collections yet. Create your first collection to showcase products.</p>
                <a href="{{ route('admin.product-collections.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Collection
                </a>
            </div>
        @endif
    </div>
</div>

@endsection
