@extends('account.layouts.account')

@section('title', 'Shipping Address')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Shipping Address</h4>
                    <form>
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="Enter your shipping address">
                        </div>
                        <div class="mb-3">
                            <label for="shipping_city" class="form-label">City</label>
                            <input type="text" class="form-control" id="shipping_city" name="shipping_city" placeholder="Enter your city">
                        </div>
                        <div class="mb-3">
                            <label for="shipping_state" class="form-label">State</label>
                            <input type="text" class="form-control" id="shipping_state" name="shipping_state" placeholder="Enter your state">
                        </div>
                        <div class="mb-3">
                            <label for="shipping_zip" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="shipping_zip" name="shipping_zip" placeholder="Enter your zip code">
                        </div>
                        <div class="mb-3">
                            <label for="shipping_country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="shipping_country" name="shipping_country" placeholder="Enter your country">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Shipping Address</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection