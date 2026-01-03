@php
    $isActive = request()->fullUrl() == url($item['link']);
    $hasChildren = !empty($item['child']);
    // Get product count for this category if it's a category link
    $productCount = 0;
    $categoryId = null;
    if (preg_match('/category=(\d+)/', $item['link'], $matches)) {
        $categoryId = $matches[1];
        $productCount = \App\Models\Product::whereHas('categories', fn($q) => $q->where('product_category_id', $categoryId))->where('published', 1)->count();
    }
    $itemId = $item['id'] ?? Str::slug($item['label']);
    $indentLevel = $level;
//    $indent = $level > 0 ? 'ms-4' : '';
@endphp
<li class="cat-item cat-item-{{ $categoryId ?? $itemId }} {{ $isActive ? 'active' : '' }} {{ $hasChildren ? 'has-children' : '' }}" data-level="{{ $indentLevel }}">
    <div class="custom-control custom-checkbox category-grid" style="flex-grow: 1;">
        <input type="checkbox" class="form-check-input square category-filter" id="cat-{{ $itemId }}" value="{{ $categoryId }}" {{ $isActive ? 'checked' : '' }}>
        <label class="form-check-label text-start" style="flex-grow: 1;" for="cat-{{ $itemId }}">{{ $item['label'] }}</label>
        <span class="cat-count" style="margin-left: auto;">({{ str_pad($productCount, 2, '0', STR_PAD_LEFT) }})</span>
    </div>
    @if($hasChildren)
        <ul class="children">
            @foreach($item['child'] as $child)
                @include('site.shop.partials.category-menu-item', ['item' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>
