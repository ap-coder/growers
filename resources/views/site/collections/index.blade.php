@extends('site.layouts.app')

@section('title', 'Collections - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <h1>Collections</h1>
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" style="color: #fff;">Home</a></li>
                    <li class="breadcrumb-item active" style="color: #fff;">Collections</li>
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
            @forelse($collections as $collection)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 m-b30">
                <div class="portfolio-box style-2">
                    <div class="dz-media">
                        <a href="{{ route('site.collections.show', $collection->slug) }}">
                            @if($collection->products->count() > 0 && $collection->products->first()->hasMedia('images'))
                                <img src="{{ $collection->products->first()->getFirstMediaUrl('images', 'large') }}" alt="{{ $collection->name }}">
                            @else
                                <img src="{{ asset('site/images/portfolio/portfolio5/pic1.jpg') }}" alt="{{ $collection->name }}">
                            @endif
                        </a>
                    </div>
                    <div class="dz-content">
                        <div class="product-tag">
                            <span class="badge">{{ $collection->layout_name }}</span>
                        </div>
                        <h2 class="title"><a href="{{ route('site.collections.show', $collection->slug) }}">{{ $collection->name }}</a></h2>
                        @if($collection->description)
                        <p class="text-muted small">{{ Str::limit($collection->description, 100) }}</p>
                        @endif
                        <small class="text-muted">{{ $collection->products->count() }} products</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h5>No collections available</h5>
                    <p class="mb-0">Check back later for new collections.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
