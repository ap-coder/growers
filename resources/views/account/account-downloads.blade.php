@extends('account.layouts.account')

@section('title', 'Your Downloads')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Your Downloads</h4>
                    <div class="downloads-list">
                        <div class="download-item mb-4">
                            <h5>Product 1</h5>
                            <p>Downloadable content for Product 1</p>
                            <a href="#" class="btn btn-secondary">Download</a>
                        </div>
                        <div class="download-item mb-4">
                            <h5>Product 2</h5>
                            <p>Downloadable content for Product 2</p>
                            <a href="#" class="btn btn-secondary">Download</a>
                        </div>
                        <div class="download-item mb-4">
                            <h5>Product 3</h5>
                            <p>Downloadable content for Product 3</p>
                            <a href="#" class="btn btn-secondary">Download</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection