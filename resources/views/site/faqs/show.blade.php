@extends('site.layouts.app')

@section('title', $category->category . ' - FAQs - Pacific Plant Growers')

@section('content')
<div class="page-content">
    <section class="px-3">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 faq-side-content" style="background-image:url('{{ asset('site/images/background/bg3.jpg') }}');">
                <div class="dz-bnr-inr-entry wow fadeInUp" data-wow-delay="0.1s">
                    <h1>{{ $category->category }}</h1>
                    <nav aria-label="breadcrumb text-align-start" class="breadcrumb-row mb-lg-4 mb-3">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('site.faqs.index') }}">FAQs</a></li>
                            <li class="breadcrumb-item active">{{ $category->category }}</li>
                        </ul>
                    </nav>
                </div>
                <div class="faq-head wow fadeInUp" data-wow-delay="0.4s">
                    <div class="search_widget wow fadeInUp" data-wow-delay="0.3s">
                        <form class="dzSearch" action="{{ route('site.faqs.index') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-0">
                                    <input name="search" type="search" class="form-control border-0" placeholder="Search FAQs">
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
                <ul class="list-check style-1 m-b30 wow fadeInUp d-none d-xl-flex" data-wow-delay="0.2s">
                    @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('site.faqs.show', $cat->slug) }}" class="{{ $cat->id == $category->id ? 'fw-bold' : '' }}">
                            {{ $cat->category }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            
            <div class="col-xl-6 col-lg-6 col-md-12 faq-end-content">
                <div class="accordion dz-accordion accordion-sm" id="accordionFaq1">
                    @foreach($questions as $index => $question)
                    <div class="accordion-item" id="question-{{ $question->id }}">
                        <h2 class="accordion-header" id="heading{{ $question->id }}">
                            <a href="#" class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" data-bs-toggle="collapse" data-bs-target="#collapse{{ $question->id }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $question->id }}">
                                {{ $question->question }}
                                <span class="toggle-close"></span>
                            </a>
                        </h2>
                        <div id="collapse{{ $question->id }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $question->id }}" data-bs-parent="#accordionFaq1">
                            <div class="accordion-body">
                                {!! $question->answer !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    @if($questions->isEmpty())
                    <div class="alert alert-info">
                        <p class="mb-0">No questions in this category yet.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
@parent
<script>
$(document).ready(function() {
    // Open specific question if hash is present
    if (window.location.hash) {
        var questionId = window.location.hash.replace('#question-', '');
        var $target = $('#collapse' + questionId);
        if ($target.length) {
            // Close all others
            $('.accordion-collapse').removeClass('show');
            $('.accordion-button').addClass('collapsed');
            // Open target
            $target.addClass('show');
            $target.prev().find('.accordion-button').removeClass('collapsed');
            // Scroll to it
            setTimeout(function() {
                $('html, body').animate({
                    scrollTop: $('#question-' + questionId).offset().top - 100
                }, 500);
            }, 100);
        }
    }
});
</script>
@endsection
