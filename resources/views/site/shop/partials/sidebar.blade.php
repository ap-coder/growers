<div class="shop-filter mt-xl-2 mt-0">
    <aside>
        <div class="d-flex align-items-center justify-content-between m-b30">
            <h6 class="title mb-0 d-flex">
                <i class="flaticon-filter me-2"></i>
                Filter
            </h6>
        </div>

        <div class="widget widget_search">
            <form action="{{ route('site.shop.index') }}" method="GET">
                <div class="form-group">
                    <div class="input-group">
                        <input name="search" required="required" type="search" class="form-control" placeholder="Search Here" value="{{ request('search') }}">
                        <div class="input-group-addon">
                            <button name="submit" value="Submit" type="submit" class="btn">
                                <i class="icon feather icon-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="widget widget_categories">
            <h2 class="widget-title">Product Category</h2>

            @php
                $categoryMenu = \App\Menu\Facades\Menu::getByName('Product Categories');
            @endphp

            @if(!empty($categoryMenu))
                <ul class="list-unstyled">
                    @foreach($categoryMenu as $item)
                        @include('site.shop.partials.category-menu-item', ['item' => $item, 'level' => 0])
                    @endforeach
                </ul>
            @else
                <ul class="list-unstyled">
                    @foreach($categories as $category)
                        <li class="cat-item cat-item-{{ $category->id }}">
                            <div class="custom-control custom-checkbox category-grid" style="flex-grow: 1;">
                                <input type="checkbox" class="form-check-input square category-filter" id="category-{{ $category->id }}" value="{{ $category->id }}"{{ request('category') == $category->id ? 'checked' : '' }}>
                                <label class="form-check-label text-start" for="category-{{ $category->id }}">{{ $category->name }}</label>
                                <span class="cat-count">({{ $category->products_count ?? $category->products()->count() }})</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>


        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        <div class="widget recent-posts-entry">
            <h3 class="widget-title">Featured Products</h3>
            <div class="widget-post-bx">
                @foreach($featuredProducts as $featured)
                @php
                    $placeholder = 'https://placehold.co/80x80/EEE/31343C/webp?font=oswald&text=' . urlencode($featured->name);
                    $featuredPrice = $featured->getPriceForClient(auth()->user()->client_id ?? null);
                @endphp
                <div class="widget-post clearfix">
                    <div class="dz-media">
                        <a href="{{ route('site.shop.product', $featured) }}">
                            @if($featured->is_fake || !$featured->photo)
                                <img src="{{ $placeholder }}" alt="{{ $featured->name }}">
                            @else
                                <img src="{{ $featured->photo->featured }}" alt="{{ $featured->name }}">
                            @endif
                        </a>
                    </div>
                    <div class="dz-info">
                        <h6 class="title"><a href="{{ route('site.shop.product', $featured) }}">{{ Str::limit($featured->name, 25, '...') }}</a></h6>
                        <span class="price">${{ number_format($featuredPrice, 2) }} @if($featured->full_price && $featured->full_price > $featuredPrice)<del>${{ number_format($featured->full_price, 2) }}</del>@endif</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </aside>
</div>
