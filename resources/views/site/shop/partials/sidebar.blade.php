<div class="shop-filter">
    <div class="widget widget_categories">
        <h4 class="widget-title">Product Categories</h4>
        <ul>
            <li class="{{ !request('category') ? 'active' : '' }}">
                <a href="{{ route('site.shop.index') }}">All Products</a>
            </li>
            @foreach($categories as $category)
                <li class="{{ request('category') == $category->id ? 'active' : '' }}">
                    <a href="{{ route('site.shop.index', ['category' => $category->id]) }}">
                        {{ $category->name }}
                        <span class="badge">{{ $category->products_count ?? $category->products()->count() }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="widget">
        <h4 class="widget-title">Sort By</h4>
        <select class="form-select" onchange="window.location.href=this.value">
            <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'name'])) }}" {{ request('sort', 'name') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
            <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'price_low'])) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'price_high'])) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
            <option value="{{ route('site.shop.index', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
        </select>
    </div>
</div>
