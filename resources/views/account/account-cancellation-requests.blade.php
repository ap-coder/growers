@extends('account.layouts.account')

@section('title', 'Cancellation Requests')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Your Cancellation Requests</h4>
                    <div class="cancellation-requests-list">
                        <div class="cancellation-request mb-4">
                            <h5>Order #12345</h5>
                            <p>Date Requested: March 15, 2024</p>
                            <p>Status: <span class="badge bg-warning">Pending</span></p>
                            <a href="#" class="btn btn-secondary">View Details</a>
                        </div>
                        <div class="cancellation-request mb-4">
                            <h5>Order #12346</h5>
                            <p>Date Requested: April 1, 2024</p>
                            <p>Status: <span class="badge bg-success">Approved</span></p>
                            <a href="#" class="btn btn-secondary">View Details</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection