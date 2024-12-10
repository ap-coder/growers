@extends('account.layouts.account')

@section('title', 'Billing Address')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Billing Address</h4>
                    <form>
                        <div class="mb-3">
                            <label for="billing_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="billing_address" name="billing_address" placeholder="Enter your billing address">
                        </div>
                        <div class="mb-3">
                            <label for="billing_city" class="form-label">City</label>
                            <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="Enter your city">
                        </div>
                        <div class="mb-3">
                            <label for="billing_state" class="form-label">State</label>
                            <input type="text" class="form-control" id="billing_state" name="billing_state" placeholder="Enter your state">
                        </div>
                        <div class="mb-3">
                            <label for="billing_zip" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="billing_zip" name="billing_zip" placeholder="Enter your zip code">
                        </div>
                        <div class="mb-3">
                            <label for="billing_country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="billing_country" name="billing_country" placeholder="Enter your country">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Billing Address</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
