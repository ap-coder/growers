@php
    $price = $product->getPriceForClient($clientId ?? null);
    $placeholder = 'https://placehold.co/600x600/EEEEEE/000000?text=' . urlencode($product->name);
@endphp
<div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 m-md-b15 m-sm-b0 m-b30">
	<div class="shop-card debug">
		<div class="dz-media debug">
			@if($product->is_fake)
				<img src="{{ $placeholder }}" alt="{{ $product->name }}">
			@else
				<img src="{{ $product->photo->shop_card ?? $placeholder }}" alt="{{ $product->name }}">
			@endif
			<div class="shop-meta debug">
				<a href="{{ route('site.shop.product', $product) }}" class="btn btn-primary meta-icon">
					<i class="flaticon flaticon-eye d-md-none d-block"></i>
					<span class="d-md-block d-none"><i class="flaticon flaticon-eye"></i></span>
				</a>

				<div class="btn btn-primary meta-icon dz-wishicon">
					<i class="icon feather icon-heart dz-heart"></i>
					<i class="icon feather icon-heart-on dz-heart-fill"></i>
				</div>
				<div class="btn btn-primary meta-icon dz-carticon">
					<i class="flaticon flaticon-basket"></i>
					<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
				</div>

			</div>
		</div>
		<div class="dz-content equalHeights debug">
			<h2 class="title"><a href="{{ route('site.shop.product', $product) }}">{{ $product->name }}</a></h2>
			<span class="price">
				@if($price)
					${{ number_format($price, 2) }}
					@if($product->full_price)
						<del>${{ number_format($product->full_price, 2) }}</del>
					@endif
				@endif
			</span>
		</div>
	</div>
</div>
