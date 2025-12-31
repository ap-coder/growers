@extends('site.layouts.app')

@section('title', 'My Orders - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.dashboard') }}">Account</a></li>
                    <li class="breadcrumb-item">Orders</li>
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
                    <h4 class="title mb-4">My Orders</h4>
                    
                    @if(isset($orders) && $orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Delivery Date</th>
                                    <th>Status</th>
                                    <th>Items</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><strong>{{ $order->number }}</strong></td>
                                    <td>{{ $order->created_at->format('m/d/Y') }}</td>
                                    <td>{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('m/d/Y') : '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->orderItems->count() }} items</td>
                                    <td>
                                        <a href="{{ route('site.account.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if($orders->hasPages())
                    <div class="mt-3">
                        {{ $orders->links() }}
                    </div>
                    @endif
                    @else
                    <div class="alert alert-info">
                        <p class="mb-0">You haven't placed any orders yet.</p>
                        <a href="{{ route('frontend.products.index') }}" class="btn btn-primary mt-3">Browse Products</a>
                    </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
