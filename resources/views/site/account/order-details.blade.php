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
                <div class="account-card order-details">
                    <div class="order-head">
                        <div class="head-thumb">
                            @php
                                $logo = config('settings.site_logo') ?? asset('site/images/logo.svg');
                            @endphp
                            <img src="{{ $logo }}" alt="Pacific Plant Growers" style="max-width: 80px;">
                        </div>
                        <div class="clearfix m-l20">
                            <div class="badge bg-{{ $order->status == 'Fullfilled' ? 'success' : ($order->status == 'new' ? 'warning' : 'info') }}">{{ ucfirst($order->status) }}</div>
                            <h4 class="mb-0">Order #{{ $order->number }}</h4>
                        </div>
                    </div>
                    
                    <div class="row mb-sm-4 mb-2">
                        <div class="col-sm-6">
                            <div class="shiping-tracker-detail">
                                <span>Order Date</span>
                                <h6 class="title">{{ $order->created_at->format('F d, Y, H:i:s') }}</h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="shiping-tracker-detail">
                                <span>Store</span>
                                <h6 class="title">{{ $order->client->name ?? 'N/A' }}</h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="shiping-tracker-detail">
                                <span>Estimated Delivery</span>
                                <h6 class="title">
                                    @if($order->estimated_delivery)
                                        {{ \Carbon\Carbon::parse($order->estimated_delivery)->format('F d, Y') }}
                                    @else
                                        <em>To be determined</em>
                                    @endif
                                </h6>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="shiping-tracker-detail">
                                <span>Delivery Address</span>
                                <h6 class="title">{{ $order->delivery_details ?? 'N/A' }}</h6>
                            </div>
                        </div>
                    </div>
                    
                    <div class="content-btn m-b15">
                        <a href="{{ route('order.invoice.download', $order->id) }}" class="btn btn-secondary me-xl-3 me-2 m-b15 btnhover20">
                            <i class="fas fa-download"></i> Download Invoice
                        </a>
                        {{-- <a href="#" class="btn btn-outline-secondary m-b15 me-xl-3 me-2 btnhover20">Request Confirmation</a> --}}
                        {{-- <a href="#" class="btn btn-outline-danger m-b15 btnhover20">Cancel Order</a> --}}
                    </div>
                    
                    <div class="clearfix">
                        <div class="dz-tabs style-3">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-order-history-tab" data-bs-toggle="tab" data-bs-target="#nav-order-history" role="tab" aria-controls="nav-order-history" aria-selected="true">Order History</button>
                                <button class="nav-link" id="nav-delivery-tab" data-bs-toggle="tab" data-bs-target="#nav-delivery" role="tab" aria-controls="nav-delivery" aria-selected="false">Delivery Info</button>
                                <button class="nav-link" id="nav-order-details-tab" data-bs-toggle="tab" data-bs-target="#nav-order-details" role="tab" aria-controls="nav-order-details" aria-selected="false">Order Details</button>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            {{-- Order History Tab --}}
                            <div class="tab-pane fade show active" id="nav-order-history" role="tabpanel" aria-labelledby="nav-order-history-tab" tabindex="0">
                                <h5 class="mb-3">Previous Orders</h5>
                                @php
                                    $previousOrders = \App\Models\Order::where('client_id', $order->client_id)
                                        ->where('id', '!=', $order->id)
                                        ->orderBy('created_at', 'desc')
                                        ->limit(10)
                                        ->get();
                                @endphp
                                
                                @if($previousOrders->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Order #</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th class="text-end">Total</th>
                                                    <th class="text-center">Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($previousOrders as $prevOrder)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('site.account.order-details', $prevOrder->id) }}">
                                                            #{{ $prevOrder->number }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $prevOrder->created_at->format('m/d/Y') }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $prevOrder->status == 'Fullfilled' ? 'success' : ($prevOrder->status == 'new' ? 'warning' : 'info') }}">
                                                            {{ ucfirst($prevOrder->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end">${{ number_format($prevOrder->total_price ?? 0, 2) }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('order.invoice.download', $prevOrder->id) }}" class="btn btn-sm btn-outline-secondary">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted">No previous orders found.</p>
                                @endif
                            </div>
                            
                            {{-- Delivery Info Tab --}}
                            <div class="tab-pane fade" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab" tabindex="0">
                                <h5 class="mb-3">Delivery Information</h5>
                                @if($order->delivery_info)
                                    <p>{!! nl2br(e($order->delivery_info)) !!}</p>
                                @else
                                    <p class="text-muted">Delivery information will be updated when your order is being processed.</p>
                                @endif
                                
                                <div class="mt-4">
                                    <h6>Delivery Address</h6>
                                    <p>{{ $order->delivery_details ?? 'N/A' }}</p>
                                </div>
                                
                                @if($order->estimated_delivery)
                                <div class="mt-3">
                                    <h6>Estimated Delivery Date</h6>
                                    <p>{{ \Carbon\Carbon::parse($order->estimated_delivery)->format('F d, Y') }}</p>
                                </div>
                                @endif
                            </div>
                            
                            {{-- Order Details Tab --}}
                            <div class="tab-pane fade" id="nav-order-details" role="tabpanel" aria-labelledby="nav-order-details-tab" tabindex="0">
                                <h5 class="text-success mb-4">Thank you! Your order has been received</h5>
                                <ul class="tracking-receiver">
                                    <li>Order Number: <strong>#{{ $order->number }}</strong></li>
                                    <li>Date: <strong>{{ $order->created_at->format('m/d/Y, h:i A') }}</strong></li>
                                    <li>Total: <strong>${{ number_format($order->total_price ?? 0, 2) }}</strong></li>
                                    <li>Status: <strong>{{ ucfirst($order->status) }}</strong></li>
                                    @if($order->ordered_by_name)
                                    <li>Ordered By: <strong>{{ $order->ordered_by_name }}</strong></li>
                                    @endif
                                    @if($order->ordered_by_phone)
                                    <li>Contact Phone: <strong>{{ $order->ordered_by_phone }}</strong></li>
                                    @endif
                                </ul>
                                
                                <h6 class="mt-4 mb-3">Order Items</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Product</th>
                                                <th>SKU</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">Price</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->orderItems as $item)
                                            <tr>
                                                <td>{{ $item->product->name ?? 'N/A' }}</td>
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
                                
                                @if($order->special_request)
                                <div class="mt-4">
                                    <h6>Special Instructions</h6>
                                    <p>{{ $order->special_request }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
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
