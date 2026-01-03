@extends('site.layouts.app')

@section('title', 'Shop - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr dz-bnr-inr-sm" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
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
        <div class="row">
            <div class="col-xl-3 col-lg-4 m-b30">
                @include('site.shop.partials.sidebar')
            </div>
            <div class="col-xl-9 col-lg-8">
                @include('site.shop.partials.grid-controls')
                
                <div class="tab-content" id="pills-tabContent">
                    {{-- List View --}}
                    <div class="tab-pane fade" id="tab-list-list" role="tabpanel" aria-labelledby="tab-list-list-btn">
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
                    {{-- Column/Medium Grid View (2 columns) --}}
                    <div class="tab-pane fade" id="tab-list-column" role="tabpanel" aria-labelledby="tab-list-column-btn">
                        <div class="row" data-equal=".shop-card">
                            @forelse($products as $product)
                                @include('site.shop.partials.product-card', ['product' => $product, 'colClass' => 'col-lg-6 col-md-6 col-sm-6'])
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
                    {{-- Small Grid View (3 columns) --}}
                    <div class="tab-pane fade show active" id="tab-list-grid" role="tabpanel" aria-labelledby="tab-list-grid-btn">
                        <div class="row" data-equal=".shop-card">
                            @forelse($products as $product)
                                @include('site.shop.partials.product-card', ['product' => $product, 'colClass' => 'col-xl-4 col-lg-4 col-md-6 col-sm-6'])
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
                
                <div class="row page mt-4">
                    <div class="col-md-6">
                        <p class="page-text">Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} Of {{ $products->total() }} Results</p>
                    </div>
                    <div class="col-md-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
