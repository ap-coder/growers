@extends('site.layouts.app')

@section('title', 'Order #' . $order->number . ' - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.dashboard') }}">Account</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.orders') }}">Orders</a></li>
                    <li class="breadcrumb-item">Order #{{ $order->number }}</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-inner-1">
    <div class="container">
        <div class="row">
            @include('site.layouts.partials.account-sidebar')
            
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="title mb-0">Order #{{ $order->number }}</h4>
                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }} fs-6">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Order Information</h6>
                                    <p class="mb-1"><strong>Order Date:</strong> {{ $order->created_at->format('m/d/Y h:i A') }}</p>
                                    @if($order->delivery_date)
                                    <p class="mb-1"><strong>Requested Delivery:</strong> {{ \Carbon\Carbon::parse($order->delivery_date)->format('m/d/Y') }}</p>
                                    @endif
                                    @if($order->special_request)
                                    <p class="mb-1"><strong>Special Request:</strong> {{ $order->special_request }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Delivery Details</h6>
                                    @if($order->client)
                                    <p class="mb-1"><strong>Store:</strong> {{ $order->client->name }}</p>
                                    @endif
                                    @if($order->delivery_details)
                                    <p class="mb-0">{{ $order->delivery_details }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="mb-3">Order Items</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        @if($item->product)
                                            {{ $item->product->name }}
                                        @else
                                            <em>Product unavailable</em>
                                        @endif
                                    </td>
                                    <td>{{ $item->sku ?? '-' }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">${{ number_format($item->price, 2) }}</td>
                                    <td class="text-end">${{ number_format($item->total_price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
                                    <td class="text-end">${{ number_format($order->order_total ?? 0, 2) }}</td>
                                </tr>
                                @if($order->shipping_cost)
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Shipping:</strong></td>
                                    <td class="text-end">${{ number_format($order->shipping_cost, 2) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                    <td class="text-end"><strong>${{ number_format($order->total_price ?? 0, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('site.account.orders') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Orders
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
