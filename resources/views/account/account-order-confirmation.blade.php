@extends('account.layouts.account')

@section('title', 'Order Confirmation')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Order Confirmation</h4>
                    <p class="mb-4">Thank you for your order! Your order number is <strong>#12345</strong>.</p>
                    <div class="mb-3">
                        <h5>Order Summary:</h5>
                        <ul>
                            <li>Product 1: $50.00</li>
                            <li>Product 2: $30.00</li>
                            <li>Shipping: $5.00</li>
                            <li><strong>Total: $85.00</strong></li>
                        </ul>
                    </div>
                    <a href="{{ url('/account/orders') }}" class="btn btn-primary">View Your Orders</a>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
