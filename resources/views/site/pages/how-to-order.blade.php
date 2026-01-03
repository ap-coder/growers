@extends('site.layouts.app')

@section('title', 'How to Order - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item">How to Order</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-inner-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">How to Order{{ $client ? ' - ' . $client->name : '' }}</h2>
                        
                        @if($content)
                            <div class="page-content">
                                {!! $content !!}
                            </div>
                        @else
                            <h4>Are You New to Ordering with Pacific Plant Growers?</h4>
                            <p>We have been a dedicated partner with floral departments for over 20 years. Pacific Plant Growers provides the highest quality indoor plants, plant dish gardens and plant novelties that help your floral department increase sales in the foliage category.</p>
                            
                            <h4 class="mt-4">Allocation Deliveries</h4>
                            <p>Regular, seasonal allocations are delivered to designated stores. Individual stores can supplement product with their allocation and purchase additional items that can be sent on their delivery schedule.</p>
                            
                            <h4 class="mt-4">Direct Store Deliveries</h4>
                            <p>We deliver to Utah County, Salt Lake County, and Davis County on a weekly basis. We can also coordinate dock delivery for a special occasion. If you are in our local delivery service area, it is possible to get a direct store delivery when minimum orders are met. Please order one week in advance when possible, although we often accommodate rush orders when available.</p>
                            <p>Please call us to find out if you are in our servicing area: <strong>801.790.8100</strong></p>
                            <p>We also help with Grand Openings, special events and merchandising.</p>
                            
                            <h4 class="mt-4">Standing Orders</h4>
                            <p>We can help you maintain a consistent supply of foliage and plant arrangements. Floral buyers often set up a Standing Order where a weekly, biweekly schedule of plants are delivered on a regular basis. Call us today to set up a standing order: <strong>801.790.4100</strong></p>
                            
                            <h4 class="mt-4">Placing an Order</h4>
                            <ol>
                                <li>Browse our products by category or season</li>
                                <li>Add items to your cart with desired quantities</li>
                                <li>Specify your requested delivery date</li>
                                <li>Add any special requests or notes</li>
                                <li>Submit your order</li>
                            </ol>
                            <p>You will receive a confirmation and our team will contact you if there are any questions about your order.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
