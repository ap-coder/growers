@extends('account.layouts.account')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Order Details</h4>
                    <p class="mb-4">Order Number: <strong>#12345</strong></p>
                    <div class="mb-3">
                        <h5>Products Ordered:</h5>
                        <ul>
                            <li>Product 1 - Quantity: 2 - Price: $50.00</li>
                            <li>Product 2 - Quantity: 1 - Price: $30.00</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <h5>Shipping Information:</h5>
                        <p>John Doe<br>
                        123 Main Street<br>
                        City, State, ZIP<br>
                        Country</p>
                    </div>
                    <div class="mb-3">
                        <h5>Payment Summary:</h5>
                        <ul>
                            <li>Subtotal: $130.00</li>
                            <li>Shipping: $5.00</li>
                            <li><strong>Total: $135.00</strong></li>
                        </ul>
                    </div>
                    <a href="{{ url('/account/orders') }}" class="btn btn-primary">Back to Orders</a>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection