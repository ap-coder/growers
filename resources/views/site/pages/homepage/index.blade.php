@extends('shop.layouts.cart')

@section('styles')
    @parent

@endsection

@section('content')
    @include('site.pages.homepage.partials.banner')
    @include('site.pages.homepage.partials.category')
    @include('site.pages.homepage.partials.about')
    @include('site.pages.homepage.partials.plant-section')
    @include('site.pages.homepage.partials.image-section')
    @include('site.pages.homepage.partials.product-section')
    @include('site.pages.homepage.partials.newsletter-section')
    @include('site.pages.homepage.partials.features')
@endsection

@section('scripts')
    @parent

@endsection
