@extends('account.layouts.account')

@section('title', 'Return Request Detail')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Return Request Detail</h4>
                    <div class="return-request-detail">
                        <h5>Order #12345</h5>
                        <p>Date Requested: March 15, 2024</p>
                        <p>Status: <span class="badge bg-warning">Pending</span></p>
                        <div class="mb-3">
                            <h5>Reason for Return:</h5>
                            <p>Product was damaged during shipping</p>
                        </div>
                        <div class="mb-3">
                            <h5>Items to be Returned:</h5>
                            <ul>
                                <li>Product 1 - Quantity: 1</li>
                                <li>Product 2 - Quantity: 2</li>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <h5>Additional Comments:</h5>
                            <p>The packaging was torn upon arrival, and items were damaged.</p>
                        </div>
                        <a href="#" class="btn btn-primary">Approve Return</a>
                        <a href="#" class="btn btn-danger">Reject Return</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
