<!-- Grid Layout View -->
<div class="tab-pane fade active show" id="tab-list-grid" role="tabpanel" aria-labelledby="tab-list-grid-btn">
    <div class="row gx-xl-4 g-3">
        @foreach ($products as $product)
            <div class="col-6 col-xl-3 col-lg-4 col-md-4 col-sm-6 m-md-b30 m-b30">
                <div class="shop-card style-1">
                    <div class="dz-media">
                        @if ($product->photo)
                            <img src="{{ $product->photo->url }}" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('assets/images/shop/product/default.png') }}" alt="No image available">
                        @endif
                    </div>
                    <div class="shop-meta">
                        <!-- Quick View Link (could open modal) -->
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-md w-100">
                            <i class="fa-solid fa-eye"></i>
                            <span class="d-lg-block d-none">Quick View</span>
                        </a>
                        <div class="btn btn-primary meta-icon dz-refresh">
                            <i class="flaticon flaticon-refresh dz-refresh"></i>
                            <i class="flaticon flaticon-refresh-on dz-refresh-fill"></i>
                        </div>
                        <div class="btn btn-primary meta-icon dz-wishicon">
                            <i class="icon feather icon-heart dz-heart"></i>
                            <i class="icon feather icon-heart-on dz-heart-fill"></i>
                        </div>
                        <div class="btn btn-primary meta-icon dz-carticon">
                            <i class="flaticon flaticon-shopping-cart-1 dz-cart"></i>
                            <i class="flaticon flaticon-shopping-cart-1-on dz-cart-fill"></i>
                        </div>
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
