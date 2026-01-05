@php
    $price = $product->getPriceForClient($clientId ?? null);
    $placeholder = 'https://placehold.co/600x600/EEEEEE/000000?text=' . urlencode($product->name);
    $isFavorited = auth()->check() ? $product->isFavoritedBy(auth()->user()) : false;
@endphp
<div class="col-md-12 col-sm-12">
    <div class="dz-shop-card style-2">
        <div class="dz-media">
            @if($product->is_fake)
                <img src="{{ $placeholder }}" alt="{{ $product->name }}">
            @else
                <img src="{{ $product->photo->shop_card ?? $placeholder }}" alt="{{ $product->name }}">
            @endif
        </div>
        <div class="dz-content">
            <div class="dz-header">
                <div>
                    <h2 class="title mb-0"><a href="{{ route('site.shop.product', $product) }}">{{ $product->name }}</a></h2>
                    @if($product->categories->count() > 0)
                        <ul class="dz-tags">
                            @foreach($product->categories->take(2) as $category)
                                <li><a href="{{ route('site.shop.index', ['category' => $category->id]) }}">{{ $category->name }}{{ !$loop->last ? ',' : '' }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="d-flex">
                    <a href="{{ route('site.shop.product', $product) }}" class="btn btn-secondary btn-md btn-icon">
                        <i class="icon feather icon-eye d-md-none d-block"></i>
                        <span class="d-md-block d-none">View</span>
                    </a>
                    <div class="bookmark-btn style-1">
                        <input class="form-check-input" type="checkbox" id="favoriteCheck{{ $product->id }}" {{ $isFavorited ? 'checked' : '' }} data-url="{{ route('site.wishlist.toggle', $product) }}">
                        <label class="form-check-label" for="favoriteCheck{{ $product->id }}"><i class="flaticon flaticon-heart-3"></i></label>
                    </div>
                </div>
            </div>
            <div class="dz-body">
                <div class="dz-rating-box">
                    <div>
                        @if($product->excerpt)
                            <p class="dz-para">{{ Str::limit($product->excerpt, 180, '...') }}</p>
                        @elseif($product->description)
                            <p class="dz-para">{{ Str::limit(strip_tags($product->description), 180, '...') }}</p>
                        @endif
                    </div>
                </div>
                <div class="rate">
                    <div class="d-flex align-items-center mb-xl-3 mb-2">
                        <div class="meta-content">
                            <span class="price-name">Price</span>
                            <span class="price">
                                @if($price)
                                    ${{ number_format($price, 2) }}
                                @else
                                    Contact for pricing
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
