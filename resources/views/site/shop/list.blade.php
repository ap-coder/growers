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
        <div class="row">
            <div class="col-lg-12">
                @include('site.shop.partials.grid-controls')
                
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
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
