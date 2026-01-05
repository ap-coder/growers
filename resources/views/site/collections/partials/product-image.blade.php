{{-- Product image for collections - handles both real and dummy products --}}
@php
    $placeholder = 'https://placehold.co/600x400/EEE/31343C/webp?font=oswald&text=' . urlencode($product->name);
    $size = $size ?? 'large';
@endphp
@if($product->is_fake || !$product->photo)
    <img src="{{ $placeholder }}" alt="{{ $product->name }}">
@else
    <img src="{{ $product->photo->url }}" alt="{{ $product->name }}">
@endif
