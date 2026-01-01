@extends('site.layouts.app')

@section('title', 'Shop - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <h1>Shop</h1>
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<section class="content-inner">
    <div class="container-fluid px-4">
        <div class="row m-b30">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="mb-2">
                        <span class="text-muted">Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products</span>
                    </div>
                    <div class="d-flex gap-2 mb-2">
                        <select class="form-select form-select-sm" style="width: auto;" onchange="window.location.href=this.value">
                            <option value="{{ route('site.shop.index', request()->except('category')) }}">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ route('site.shop.index', array_merge(request()->except('category'), ['category' => $category->id])) }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <select class="form-select form-select-sm" style="width: auto;" onchange="window.location.href=this.value">
                            <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'name'])) }}" {{ request('sort', 'name') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'price_low'])) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low-High</option>
                            <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'price_high'])) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High-Low</option>
                            <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            @forelse($products as $product)
                @include('site.shop.partials.product-card', ['product' => $product, 'colSize' => 2])
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        No products found. Try adjusting your filters.
                    </div>
                </div>
            @endforelse
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection
