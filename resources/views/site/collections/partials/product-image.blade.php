{{-- Product image for collections - handles both real and dummy products --}}
@php
    $placeholder = 'https://placehold.co/600x400/EEEEEE/000000?text=' . urlencode($product->name);
    $size = $size ?? 'large';
@endphp
@if($product->is_fake || !$product->hasMedia('images'))
    <img src="{{ $placeholder }}" alt="{{ $product->name }}">
@else
    <img src="{{ $product->getFirstMediaUrl('images', $size) }}" alt="{{ $product->name }}">
@endif
