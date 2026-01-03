@extends('site.layouts.app')

@section('title', $collection->name . ' - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <h1>{{ $collection->name }}</h1>
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.shop.index') }}">Shop</a></li>
                    <li class="breadcrumb-item active">{{ $collection->name }}</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<section class="content-inner pt-0 z-index-unset">
    @if($collection->description)
    <div class="container mb-4">
        <p class="text-muted text-center">{{ $collection->description }}</p>
    </div>
    @endif
    
    @php
        $categories = $products->pluck('categories')->flatten()->unique('id');
    @endphp
    
    @if($categories->count() > 1)
    <div class="site-filters style-2 clearfix center">
        <ul class="filters" data-bs-toggle="buttons">
            <li data-filter=".All" class="btn active">
                <a href="javascript:void(0);">All</a>
            </li>
            @foreach($categories as $category)
            <li data-filter=".cat-{{ $category->id }}" class="btn">
                <a href="javascript:void(0);">{{ $category->name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="container">
        <div class="clearfix">
            <ul id="masonry" class="lightgallery row" data-masonry='{"percentPosition": true}'>
                @foreach($products as $product)
                @php
                    $categoryClasses = $product->categories->pluck('id')->map(fn($id) => 'cat-' . $id)->implode(' ');
                    $placeholder = 'https://placehold.co/600x400/EEEEEE/000000?text=' . urlencode($product->name);
                @endphp
                <li class="card-container col-xl-4 col-lg-4 col-md-6 col-sm-6 m-b30 All {{ $categoryClasses }}">
                    <div class="portfolio-box style-2">
                        <div class="dz-media">
                            <a href="{{ route('site.shop.product', $product->slug ?? $product->id) }}">
                                @if($product->is_fake || !$product->hasMedia('images'))
                                    <img src="{{ $placeholder }}" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ $product->getFirstMediaUrl('images', 'large') }}" alt="{{ $product->name }}">
                                @endif
                            </a>
                        </div>
                        <div class="dz-content">
                            @if($product->categories->count() > 0)
                            <div class="product-tag">
                                <a href="{{ route('site.shop.index', ['category' => $product->categories->first()->slug]) }}">
                                    <span class="badge">{{ $product->categories->first()->name }}</span>
                                </a>
                            </div>
                            @endif
                            <h2 class="title"><a href="{{ route('site.shop.product', $product->slug ?? $product->id) }}">{{ $product->name }}</a></h2>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@parent
<script src="{{ asset('site/vendor/masonry/masonry-4.2.2.js') }}"></script>
<script src="{{ asset('site/vendor/masonry/masonry.filter.js') }}"></script>
<script>
$(document).ready(function() {
    var $grid = $('#masonry').masonry({
        itemSelector: '.card-container',
        percentPosition: true
    });
    
    $('.site-filters .filters li').on('click', function() {
        var filterValue = $(this).attr('data-filter');
        $('.site-filters .filters li').removeClass('active');
        $(this).addClass('active');
        
        if (filterValue === '.All') {
            $grid.find('.card-container').show();
        } else {
            $grid.find('.card-container').hide();
            $grid.find(filterValue).show();
        }
        $grid.masonry('layout');
    });
});
</script>
@endsection
