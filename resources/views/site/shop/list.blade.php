@extends('site.layouts.app')

@section('title', 'Shop - Pacific Plant Growers')

@section('banner')

<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Shop</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<section class="content-inner-3 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <div class="sticky-xl-top">
                    <a href="javascript:void(0);" class="panel-close-btn">
                        <svg width="35" height="35" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M37.748 12.5L12.748 37.5" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.748 12.5L37.748 37.5" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    @include('site.shop.partials.sidebar')
                </div>
            </div>
            <div class="col-xl-9">
                @include('site.shop.partials.grid-controls')

                <div class="row">
                    <div class="col-12 tab-content shop-" id="pills-tabContent">
                        {{-- List View --}}
                        <div class="tab-pane fade show active" id="tab-list-list" role="tabpanel" aria-labelledby="tab-list-list-btn">
                            <div class="row" data-equal=".dz-shop-card">
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

                            <div class="row gx-xl-4 g-3 mb-xl-0 mb-md-0 mb-3">
                                @forelse($products as $product)
                                    @include('site.shop.partials.product-card-column', ['product' => $product, 'colClass' => 'col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 m-md-b15 m-sm-b0 m-b30'])
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
                        <div class="tab-pane fade" id="tab-list-grid" role="tabpanel" aria-labelledby="tab-list-grid-btn">
                            <div class="row gx-xl-4 g-3 mb-xl-0 mb-md-0 mb-3">
                                @forelse($products as $product)
                                    @include('site.shop.partials.product-card', ['product' => $product])
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
                </div>

                @include('site.shop.partials.pagination', ['products' => $products])
            </div>
        </div>
    </div>
</section>


@endsection
@section('scripts')

    <script>
        // document.querySelectorAll('[class]').forEach(e =>
        //     console.log(e.tagName, e.className)
        // );
        $(document).ready(function() {
            // $('.shop-card').equalHeights();
        });
    </script>
@endsection
