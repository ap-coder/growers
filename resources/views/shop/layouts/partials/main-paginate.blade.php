<!-- Pagination Section -->
<div class="row page mt-0">
    <div class="col-md-6">
        <p class="page-text">Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} Results</p>
    </div>
    <div class="col-md-6">
        <nav aria-label="Product Pagination">
            <ul class="pagination style-1">
                {{ $products->links() }}
            </ul>
        </nav>
    </div>
</div>
