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
            <div class="row">
                @php
                    $delays = ['0.1s', '0.2s', '0.3s', '0.4s', '0.5s', '0.6s'];
                    $delayIndex = 0;
                @endphp
                @foreach($categories as $category)
                    @foreach($category->questions->take(2) as $question)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 m-b30 wow fadeInUp" data-wow-delay="{{ $delays[$delayIndex % 6] }}">
                        <div class="faq-content-box style-1">
                            <div>
                                <h2 class="dz-title">{{ Str::limit($question->question, 50) }}</h2>
                                <p>{{ Str::limit(strip_tags($question->answer), 150) }}</p>
                            </div>
                            <a href="{{ route('site.faqs.show', $category->slug) }}#question-{{ $question->id }}" class="faq-link">
                                <i class="flaticon-plus"></i>
                                Show More
                            </a>
                        </div>
                    </div>
                    @php $delayIndex++; @endphp
                    @endforeach
                @endforeach
                
                @if($categories->isEmpty() || $categories->sum(fn($c) => $c->questions->count()) == 0)
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h5>No FAQs available</h5>
                        <p class="mb-0">Check back later for frequently asked questions.</p>
                    </div>
                </div>
                @endif
            </div>
            
            @if($categories->count() > 0)
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <h3 class="mb-4">Browse by Category</h3>
                </div>
                @foreach($categories as $category)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 m-b30">
                    <a href="{{ route('site.faqs.show', $category->slug) }}" class="btn btn-outline-primary btn-block">
                        {{ $category->category }}
                        <span class="badge bg-primary ms-2">{{ $category->questions->count() }}</span>
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
