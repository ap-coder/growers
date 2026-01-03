@if($products->hasPages())
<div class="row page mt-0">
    <div class="col-md-6">
        <p class="page-text">Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} Of {{ $products->total() }} Results</p>
    </div>
    <div class="col-md-6">
        <nav aria-label="Blog Pagination">
            <ul class="pagination style-1 p-t20">
                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endforeach
                @if($products->hasMorePages())
                    <li class="page-item"><a class="page-link next" href="{{ $products->nextPageUrl() }}">Next</a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>
@endif
