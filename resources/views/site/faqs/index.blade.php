@extends('site.layouts.app')

@section('title', 'FAQs - Pacific Plant Growers')

@section('content')
<div class="page-content">
    <section class="content-inner main-faq-content">
        <div class="container">
            <div class="row faq-head">
                <div class="col-12 text-center">
                    <h1 class="title wow fadeInUp" data-wow-delay="0.1s">Hi! How can we help you?</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row wow fadeInUp" data-wow-delay="0.2s">
                        <ul class="breadcrumb mb-lg-4 mb-3">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">FAQs</li>
                        </ul>
                    </nav>
                    <div class="search_widget wow fadeInUp" data-wow-delay="0.3s">
                        <form class="dzSearch" action="{{ route('site.faqs.index') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-0">
                                    <input name="search" type="search" class="form-control" placeholder="Search FAQ" value="{{ request('search') }}">
                                    <div class="input-group-addon">
                                        <button type="submit" class="btn">
                                            <i class="icon feather icon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            @if($categories->count() > 0)
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h3 class="wow fadeInUp" data-wow-delay="0.1s">Select a Category</h3>
                </div>
                @php
                    $delays = ['0.1s', '0.2s', '0.3s', '0.4s', '0.5s', '0.6s'];
                @endphp
                @foreach($categories as $index => $category)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 m-b30 wow fadeInUp" data-wow-delay="{{ $delays[$index % 6] }}">
                    <a href="{{ route('site.faqs.show', $category->id) }}" class="faq-category-card">
                        <div class="faq-content-box style-1 text-center h-100">
                            <h2 class="dz-title">{{ $category->category }}</h2>
                            <p class="text-muted">{{ $category->questions->count() }} {{ Str::plural('question', $category->questions->count()) }}</p>
                            <span class="btn btn-primary btn-sm mt-2">
                                View Questions <i class="icon feather icon-arrow-right ms-1"></i>
                            </span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h5>No FAQ Categories available</h5>
                        <p class="mb-0">Check back later for frequently asked questions.</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
