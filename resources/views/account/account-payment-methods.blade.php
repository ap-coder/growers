@extends('account.layouts.account')

@section('title', 'Payment Methods')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Payment Methods</h4>
                    <div class="payment-methods-list">
                        <div class="payment-method mb-4">
                            <h5>Credit Card</h5>
                            <p>Visa ending in 1234</p>
                            <a href="#" class="btn btn-secondary">Edit</a>
                            <a href="#" class="btn btn-danger">Remove</a>
                        </div>
                        <div class="payment-method mb-4">
                            <h5>PayPal</h5>
                            <p>Email: johndoe@example.com</p>
                            <a href="#" class="btn btn-secondary">Edit</a>
                            <a href="#" class="btn btn-danger">Remove</a>
                        </div>
                        <div class="payment-method mb-4">
                            <h5>Bank Account</h5>
                            <p>Account ending in 5678</p>
                            <a href="#" class="btn btn-secondary">Edit</a>
                            <a href="#" class="btn btn-danger">Remove</a>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary">Add New Payment Method</a>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection