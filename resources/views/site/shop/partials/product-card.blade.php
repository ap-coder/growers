@php
    $price = $product->getPriceForClient($clientId ?? null);
    $colClass = $colClass ?? 'col-6 col-xl-4 col-lg-4 col-md-4 col-sm-4 m-md-b15 m-sm-b30 m-b30';
    $placeholder = 'https://placehold.co/600x600/EEEEEE/000000?text=' . urlencode($product->name);
@endphp
<div class="{{ $colClass }}">
	<div class="shop-card style-1">
		<div class="dz-media">
			@if($product->is_fake)
				<img src="{{ $placeholder }}" alt="{{ $product->name }}">
			@else
				<img src="{{ $product->photo->shop_card ?? $placeholder }}" alt="{{ $product->name }}">
			@endif
		</div>
		<div class="shop-meta">
			<a href="{{ route('site.shop.product', $product) }}" class="btn btn-primary btn-md w-100">
				<i class="fa-solid fa-eye"></i>
				<span class="d-lg-block d-none">Quick View</span>
			</a>
			<div class="btn btn-primary meta-icon dz-wishicon">
				<i class="icon feather icon-heart dz-heart"></i>
				<i class="icon feather icon-heart-on dz-heart-fill"></i>
			</div>
			{{--
			<div class="btn btn-primary meta-icon dz-refresh">
				<i class="flaticon flaticon-refresh dz-refresh"></i>
				<i class="flaticon flaticon-refresh-on dz-refresh-fill"></i>
			</div>
			<div class="btn btn-primary meta-icon dz-carticon">
				<i class="flaticon flaticon-shopping-cart-1 dz-cart"></i>
				<i class="flaticon flaticon-shopping-cart-1-on dz-cart-fill"></i>
			</div>
			--}}
		</div>
		<div class="dz-content">
			<h2 class="title"><a href="{{ route('site.shop.product', $product) }}">{{ $product->name }}</a></h2>
			<span class="price">
				@if($price)
					${{ number_format($price, 2) }}
				@else
					<span class="text-muted">Contact for pricing</span>
				@endif
			</span>
		</div>
	</div>
</div>
