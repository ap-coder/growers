@extends('account.layouts.account')

@section('title', 'Refund Requests Confirmed')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Your Confirmed Refund Requests</h4>
                    <div class="refund-requests-list">
                        <div class="refund-request mb-4">
                            <h5>Order #12345</h5>
                            <p>Date Requested: March 10, 2024</p>
                            <p>Refund Amount: <strong>$50.00</strong></p>
                            <p>Status: <span class="badge bg-success">Confirmed</span></p>
                            <a href="#" class="btn btn-secondary">View Details</a>
                        </div>
                        <div class="refund-request mb-4">
                            <h5>Order #12346</h5>
                            <p>Date Requested: March 25, 2024</p>
                            <p>Refund Amount: <strong>$80.00</strong></p>
                            <p>Status: <span class="badge bg-success">Confirmed</span></p>
                            <a href="#" class="btn btn-secondary">View Details</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection