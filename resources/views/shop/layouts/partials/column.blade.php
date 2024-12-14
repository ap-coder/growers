<!-- Column Layout View -->
<div class="tab-pane fade" id="tab-list-column" role="tabpanel" aria-labelledby="tab-list-column-btn">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 m-md-b30 m-b30">
                <div class="shop-card style-1">
                    <div class="dz-media">
                        @if ($product->photo)
                            <img src="{{ $product->photo->url }}" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('assets/images/shop/product/default.png') }}" alt="No image available">
                        @endif
                    </div>
                    <div class="dz-content">
                        <h2 class="title">
                            <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                        </h2>
                        <span class="price">
                            ${{ $product->clientPrices->first()->price ?? '0.00' }}
                            @if ($product->clientPrices->first()->original_price)
                                <del>${{ $product->clientPrices->first()->original_price }}</del>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
