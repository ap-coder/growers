@extends('site.layouts.app')

@section('title', 'Order History - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.dashboard') }}">Account</a></li>
                    <li class="breadcrumb-item">Order History</li>
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
                    <h4 class="title mb-4">Order History</h4>
                    
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-center">Invoice</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('site.account.order-details', $order->id) }}">
                                                #{{ $order->number }}
                                            </a>
                                        </td>
                                        <td>{{ $order->created_at->format('m/d/Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status == 'Fullfilled' ? 'success' : ($order->status == 'new' ? 'warning' : 'info') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="text-end">${{ number_format($order->total_price ?? 0, 2) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('order.invoice.download', $order->id) }}" class="btn btn-sm btn-outline-secondary" title="Download Invoice">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('site.account.order-details', $order->id) }}" class="btn btn-sm btn-primary">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-box-open" style="font-size: 4rem; color: #ccc;"></i>
                            <h4 class="mt-3">No orders found</h4>
                            <p class="text-muted">You haven't placed any orders yet</p>
                            <a href="{{ route('site.shop.index') }}" class="btn btn-secondary mt-3">Browse Products</a>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
