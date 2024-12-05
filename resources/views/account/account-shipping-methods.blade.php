@extends('account.layouts.account')

@section('title', 'Shipping Methods')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Shipping Methods</h4>
                    <div class="shipping-methods-list">
                        <div class="shipping-method mb-3">
                            <h5>Standard Shipping</h5>
                            <p>Delivery in 5-7 business days - <strong>$5.00</strong></p>
                            <button type="button" class="btn btn-secondary">Select</button>
                        </div>
                        <div class="shipping-method mb-3">
                            <h5>Express Shipping</h5>
                            <p>Delivery in 2-3 business days - <strong>$15.00</strong></p>
                            <button type="button" class="btn btn-secondary">Select</button>
                        </div>
                        <div class="shipping-method mb-3">
                            <h5>Overnight Shipping</h5>
                            <p>Delivery in 1 business day - <strong>$25.00</strong></p>
                            <button type="button" class="btn btn-secondary">Select</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection