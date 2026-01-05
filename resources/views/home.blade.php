@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="container-fluid">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Info Boxes --}}
        <div class="row">
            {{-- Products Box --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalProducts }}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            {{-- Orders Box --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            {{-- Clients Box --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalClients }}</h3>
                        <p>Total Clients</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('admin.clients.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            {{-- Revenue Box --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>${{ number_format($thisMonthRevenue, 0) }}</h3>
                        <p>This Month Revenue</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Second Row - Detailed Stats --}}
        <div class="row">
            {{-- Product Stats Card --}}
            <div class="col-lg-3 col-6">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-check-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Published Products</span>
                        <span class="info-box-number">{{ $publishedProducts }}</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-exclamation-triangle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Low Stock</span>
                        <span class="info-box-number">{{ $lowStockProducts }}</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-clipboard-list"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New Orders</span>
                        <span class="info-box-number">{{ $newOrders }}</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-spinner"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Processing Orders</span>
                        <span class="info-box-number">{{ $processingOrders }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content Row --}}
        <div class="row">
            {{-- Revenue Chart --}}
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Revenue Overview</h3>
                            <a href="{{ route('admin.orders.index') }}">View All Orders</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <canvas id="revenue-chart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quick Stats</h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-box text-info mr-2"></i> Published Products</span>
                                    <span class="badge badge-info">{{ $publishedProducts }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-flask text-secondary mr-2"></i> Dummy Products</span>
                                    <span class="badge badge-secondary">{{ $dummyProducts }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-users text-success mr-2"></i> Active Clients</span>
                                    <span class="badge badge-success">{{ $activeClients }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-flask text-secondary mr-2"></i> Dummy Clients</span>
                                    <span class="badge badge-secondary">{{ $dummyClients }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-user-check text-primary mr-2"></i> Active Users</span>
                                    <span class="badge badge-primary">{{ $activeUsers }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-calendar-alt text-warning mr-2"></i> Orders This Month</span>
                                    <span class="badge badge-warning">{{ $thisMonthOrders }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Activity Row --}}
        <div class="row">
            {{-- Recent Orders --}}
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Recent Orders</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-tool btn-sm">
                                <i class="fas fa-list"></i> View All
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}">
                                            #{{ $order->number }}
                                        </a>
                                    </td>
                                    <td>{{ $order->client->name ?? 'N/A' }}</td>
                                    <td>{{ $order->created_at->format('m/d/Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $order->status == 'new' ? 'warning' : ($order->status == 'Fullfilled' ? 'success' : 'info') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($order->total_price ?? 0, 2) }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-xs btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No recent orders</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Recent Products --}}
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Recent Products</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-tool btn-sm">
                                <i class="fas fa-list"></i> View All
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            @forelse($recentProducts as $product)
                            <li class="item">
                                <div class="product-img">
                                    @if($product->photo)
                                        <img src="{{ $product->photo->thumbnail ?? $product->photo->url }}" alt="{{ $product->name }}" class="img-size-50">
                                    @else
                                        <img src="https://placehold.co/50x50/EEE/31343C?text={{ substr($product->name, 0, 1) }}" alt="{{ $product->name }}" class="img-size-50">
                                    @endif
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="product-title">
                                        {{ Str::limit($product->name, 30) }}
                                        <span class="badge badge-{{ $product->published ? 'success' : 'secondary' }} float-right">
                                            {{ $product->published ? 'Published' : 'Draft' }}
                                        </span>
                                    </a>
                                    <span class="product-description">
                                        {{ $product->categories->first()->name ?? 'Uncategorized' }} | 
                                        ${{ number_format($product->base_price, 2) }}
                                    </span>
                                </div>
                            </li>
                            @empty
                            <li class="item">
                                <div class="product-info text-center text-muted w-100">
                                    No recent products
                                </div>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Add New Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
$(function () {
    // Revenue Chart
    var revenueChartCanvas = $('#revenue-chart').get(0).getContext('2d');
    var revenueData = {
        labels: {!! json_encode(array_column($monthlyRevenue, 'month')) !!},
        datasets: [{
            label: 'Revenue',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: 4,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: {!! json_encode(array_column($monthlyRevenue, 'revenue')) !!}
        }]
    };

    var revenueChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return '$' + context.parsed.y.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return '$' + value.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&,');
                    }
                }
            }
        }
    };

    new Chart(revenueChartCanvas, {
        type: 'line',
        data: revenueData,
        options: revenueChartOptions
    });
});
</script>
@endsection