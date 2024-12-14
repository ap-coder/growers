<!-- List Layout View -->
<div class="tab-pane fade" id="tab-list-list" role="tabpanel" aria-labelledby="tab-list-list-btn">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-12 col-sm-12 col-xxxl-6">
                <div class="dz-shop-card style-2">
                    <div class="dz-media">
                        @if ($product->photo)
                            <img src="{{ $product->photo->url }}" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('assets/images/shop/product/default.png') }}" alt="No image available">
                        @endif
                    </div>
                    <div class="dz-content">
                        <div class="dz-header">
                            <div>
                                <h2 class="title mb-0">
                                    <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                </h2>
                                <ul class="dz-tags">
                                    @foreach ($product->tags as $tag)
                                        <li><a href="shop-with-category.html">{{ $tag->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="review-num">
                                <ul class="dz-rating">
                                    @for ($i = 0; $i < 5; $i++)
                                        <li class="{{ $i < $product->rating ? 'star-fill' : '' }}">
                                            <i class="flaticon-star-1"></i>
                                        </li>
                                    @endfor
                                </ul>
                                <span><a href="javascript:void(0);">{{ $product->reviews_count }} Reviews</a></span>
                            </div>
                        </div>
                        <div class="dz-body">
                            <div class="dz-rating-box">
                                <p class="dz-para">{{ $product->description }}</p>
                            </div>
                            <div class="rate">
                                <div class="d-flex align-items-center mb-xl-3 mb-2">
                                    <div class="meta-content m-0">
                                        <span class="price-name">Price</span>
                                        <span class="price">${{ $product->clientPrices->first()->price ?? '0.00' }}</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-secondary btn-md btn-icon">
                                        <i class="icon feather icon-shopping-cart d-md-none d-block"></i>
                                        <span class="d-md-block d-none">Add to cart</span>
                                    </a>
                                    <div class="bookmark-btn style-1">
                                        <input class="form-check-input" type="checkbox" id="favoriteCheck{{ $product->id }}">
                                        <label class="form-check-label" for="favoriteCheck{{ $product->id }}">
                                            <i class="fa-solid fa-heart"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
