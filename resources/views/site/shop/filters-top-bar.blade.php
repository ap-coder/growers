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
    <div class="container">
        <div class="row m-b30">
            <div class="col-12">
                <div class="filter-top-bar bg-light p-3 rounded">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <form action="{{ route('site.shop.index') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary ms-2"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" onchange="window.location.href=this.value">
                                <option value="{{ route('site.shop.index', request()->except('category')) }}">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ route('site.shop.index', array_merge(request()->except('category'), ['category' => $category->id])) }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" onchange="window.location.href=this.value">
                                <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'name'])) }}" {{ request('sort', 'name') == 'name' ? 'selected' : '' }}>Sort: Name (A-Z)</option>
                                <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'price_low'])) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Sort: Price Low-High</option>
                                <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'price_high'])) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Sort: Price High-Low</option>
                                <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Sort: Newest</option>
                            </select>
                        </div>
                        <div class="col-md-2 text-end">
                            <span class="text-muted">{{ $products->total() }} products</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                @include('site.shop.partials.grid-controls')
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="view-grid" role="tabpanel" aria-labelledby="view-grid-tab">
                        <div class="row">
                            @forelse($products as $product)
                                @include('site.shop.partials.product-card', ['product' => $product, 'colSize' => 3])
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        No products found. Try adjusting your filters.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="view-list" role="tabpanel" aria-labelledby="view-list-tab">
                        <div class="row">
                            @forelse($products as $product)
                                @include('site.shop.partials.product-card-list', ['product' => $product])
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        No products found. Try adjusting your filters.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
