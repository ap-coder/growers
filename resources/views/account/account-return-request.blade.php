@extends('account.layouts.account')

@section('title', 'Return Request')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <h4 class="mb-4">Return Request</h4>
                    <form>
                        <div class="mb-3">
                            <label for="order_number" class="form-label">Order Number</label>
                            <input type="text" class="form-control" id="order_number" name="order_number" placeholder="Enter your order number">
                        </div>
                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason for Return</label>
                            <select class="form-select" id="reason" name="reason">
                                <option value="">Select a reason</option>
                                <option value="damaged">Product was damaged</option>
                                <option value="not_as_described">Product not as described</option>
                                <option value="wrong_item">Received wrong item</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comments" class="form-label">Additional Comments</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4" placeholder="Enter any additional details..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Return Request</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection