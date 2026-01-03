@extends('site.layouts.app')

@section('title', 'Shop - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Shop List</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<section class="content-inner-3 pt-3">
    <div class="container">
        <div class="row">
            {{-- Sidebar Filter --}}
            <div class="col-xl-3">
                <div class="sticky-xl-top">
                    <a href="javascript:void(0);" class="panel-close-btn">
                        <svg width="35" height="35" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M37.748 12.5L12.748 37.5" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.748 12.5L37.748 37.5" stroke="white" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    @include('site.shop.partials.sidebar')
                </div>
            </div>

            {{-- Products Grid --}}
            <div class="col-xl-9">
                @include('site.shop.partials.grid-controls')

                <div class="row">
                    <div class="col-12 tab-content shop-" id="pills-tabContent">
                        {{-- List View --}}
                        <div class="tab-pane fade show active" id="tab-list-list" role="tabpanel" aria-labelledby="tab-list-list-btn">
                            <div class="row" data-equal=".dz-shop-card">
                                @forelse($products as $product)
                                    @include('site.shop.partials.product-card-list', ['product' => $product])
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info text-center py-5">
                                            <i class="fas fa-leaf fa-3x mb-3 text-muted"></i>
                                            <h5>No products found</h5>
                                            <p class="mb-0">Try adjusting your filters or search terms.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        {{-- Column/Medium Grid View (2 columns) --}}
                        <div class="tab-pane fade" id="tab-list-column" role="tabpanel" aria-labelledby="tab-list-column-btn">
                            <div class="row gx-xl-4 g-3 mb-xl-0 mb-md-0 mb-3">
                                @forelse($products as $product)
                                    @include('site.shop.partials.product-card-column', ['product' => $product, 'colClass' => 'col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 m-md-b15 m-sm-b0 m-b30'])
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info text-center py-5">
                                            <i class="fas fa-leaf fa-3x mb-3 text-muted"></i>
                                            <h5>No products found</h5>
                                            <p class="mb-0">Try adjusting your filters or search terms.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        {{-- Small Grid View (3 columns) --}}
                        <div class="tab-pane fade" id="tab-list-grid" role="tabpanel" aria-labelledby="tab-list-grid-btn">
                            <div class="row gx-xl-4 g-3 mb-xl-0 mb-md-0 mb-3" id="products-container">
                                @forelse($products as $product)
                                    @include('site.shop.partials.product-card', ['product' => $product])
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info text-center py-5">
                                            <i class="fas fa-leaf fa-3x mb-3 text-muted"></i>
                                            <h5>No products found</h5>
                                            <p class="mb-0">Try adjusting your filters or search terms.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div id="pagination-container">
                    @include('site.shop.partials.pagination', ['products' => $products])
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    var filterTimeout;
    var currentRequest = null;

    // Function to load products via AJAX
    function loadProducts() {
        var params = {
            search: $('input[name="search"]').val(),
            category: getSelectedCategories(),
            sort: $('#sort-select').val() || 'name'
        };

        // Cancel any pending request
        if (currentRequest) {
            currentRequest.abort();
        }

        // Show loading state
        $('#products-container').addClass('loading');

        currentRequest = $.ajax({
            url: '{{ route("site.shop.index") }}',
            type: 'GET',
            data: params,
            success: function(response) {
                $('#products-container').html(response.html);
                $('#pagination-container').html(response.pagination);
                $('#showing-text').text(response.showing);

                // Update URL without reload
                var newUrl = '{{ route("site.shop.index") }}?' + $.param(params);
                window.history.pushState({}, '', newUrl);
            },
            error: function(xhr, status, error) {
                if (status !== 'abort') {
                    console.error('Error loading products:', error);
                }
            },
            complete: function() {
                $('#products-container').removeClass('loading');
                currentRequest = null;
            }
        });
    }

    // Get selected category IDs
    function getSelectedCategories() {
        var selected = [];
        $('.category-filter:checked').each(function() {
            selected.push($(this).val());
        });
        return selected.length > 0 ? selected.join(',') : '';
    }

    // Category checkbox change
    $(document).on('change', '.category-filter', function() {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(loadProducts, 300);
    });

    // Search input with debounce
    $(document).on('keyup', 'input[name="search"]', function(e) {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(loadProducts, 500);
    });

    // Search form submit
    $(document).on('submit', '.widget_search form', function(e) {
        e.preventDefault();
        loadProducts();
    });

    // Sort change
    $(document).on('change', '#sort-select', function() {
        loadProducts();
    });

    // Category dropdown change (header)
    $(document).on('change', '#category-select', function() {
        var catId = $(this).val();
        // Uncheck all sidebar checkboxes first
        $('.category-filter').prop('checked', false);
        // Check the matching sidebar checkbox if a category is selected
        if (catId) {
            $('.category-filter[value="' + catId + '"]').prop('checked', true);
        }
        loadProducts();
    });

    // Favorite checkbox change (list view)
    $(document).on('change', '.favorite-checkbox', function() {
        var checkbox = $(this);
        var url = checkbox.data('url');

        $.ajax({
            url: url,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                // Checkbox state already changed by user click
            },
            error: function(xhr) {
                // Revert checkbox on error
                checkbox.prop('checked', !checkbox.prop('checked'));
                console.error('Error toggling favorite:', xhr);
            }
        });
    });

    // Pagination clicks
    $(document).on('click', '#pagination-container .pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        // Show loading state
        $('#products-container').addClass('loading');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#products-container').html(response.html);
                $('#pagination-container').html(response.pagination);
                window.history.pushState({}, '', url);

                // Scroll to top of products
                $('html, body').animate({
                    scrollTop: $('#products-container').offset().top - 100
                }, 300);
            },
            complete: function() {
                $('#products-container').removeClass('loading');
            }
        });
    });

    // Reset filters button
    $(document).on('click', '.reset-filters', function(e) {
        e.preventDefault();
        $('input[name="search"]').val('');
        $('.category-filter').prop('checked', false);
        $('#sort-select').val('name');
        loadProducts();
    });
});
</script>
<style>
#products-container.loading {
    opacity: 0.5;
    pointer-events: none;
}
/* Align category counts in straight column */
.widget_categories .cat-item .custom-checkbox {
    justify-content: space-between;
}
</style>
@endsection
