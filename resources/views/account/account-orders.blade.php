@extends('account.layouts.account')

@section('title', 'Your Orders')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Your Orders</h4>
                    <div class="order-list">
                        <div class="order-item mb-4">
                            <h5>Order #12345</h5>
                            <p>Date: January 10, 2024</p>
                            <p>Total: $135.00</p>
                            <a href="{{ url('/account/order-details/12345') }}" class="btn btn-secondary">View Details</a>
                        </div>
                        <div class="order-item mb-4">
                            <h5>Order #12346</h5>
                            <p>Date: February 5, 2024</p>
                            <p>Total: $85.00</p>
                            <a href="{{ url('/account/order-details/12346') }}" class="btn btn-secondary">View Details</a>
                        </div>
                        <div class="order-item mb-4">
                            <h5>Order #12347</h5>
                            <p>Date: March 2, 2024</p>
                            <p>Total: $210.00</p>
                            <a href="{{ url('/account/order-details/12347') }}" class="btn btn-secondary">View Details</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection