@forelse($products as $product)
    @include('site.shop.partials.product-card', ['product' => $product, 'colClass' => 'col-xl-3 col-lg-4 col-md-6 col-sm-6'])
@empty
    <div class="col-12">
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-leaf fa-3x mb-3 text-muted"></i>
            <h5>No products found</h5>
            <p class="mb-0">Try adjusting your filters or search terms.</p>
        </div>
    </div>
@endforelse
