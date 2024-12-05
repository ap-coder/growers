@extends('account.layouts.account')

@section('title', 'Product Reviews')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Your Product Reviews</h4>
                    <div class="reviews-list">
                        <div class="review-item mb-4">
                            <h5>Product 1</h5>
                            <p>Rating: <span class="text-warning">★★★★☆</span></p>
                            <p>"Great product! Highly recommended."</p>
                            <a href="#" class="btn btn-secondary">Edit Review</a>
                        </div>
                        <div class="review-item mb-4">
                            <h5>Product 2</h5>
                            <p>Rating: <span class="text-warning">★★★☆☆</span></p>
                            <p>"Good quality but a bit pricey."</p>
                            <a href="#" class="btn btn-secondary">Edit Review</a>
                        </div>
                        <div class="review-item mb-4">
                            <h5>Product 3</h5>
                            <p>Rating: <span class="text-warning">★★★★★</span></p>
                            <p>"Absolutely loved it! Exceeded my expectations."</p>
                            <a href="#" class="btn btn-secondary">Edit Review</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection