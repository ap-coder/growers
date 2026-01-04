@extends('site.layouts.app')

@section('title', 'Addresses - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.dashboard') }}">Account</a></li>
                    <li class="breadcrumb-item">Addresses</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-inner-1">
    <div class="container">
        <div class="row">
            @include('site.layouts.partials.account-sidebar')
            
            <section class="col-xl-9 account-wrapper">
                <div class="row">
                    <div class="col-12 m-b30">
                        <p class="m-b0">The following addresses will be used on the checkout page by default.</p>
                    </div>
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    @if($addresses->count() > 0)
                        @php
                            $groupedAddresses = $addresses->groupBy('address_type');
                        @endphp
                        
                        @foreach($groupedAddresses as $type => $typeAddresses)
                            @foreach($typeAddresses as $address)
                            <div class="col-md-6 m-b30">
                                <div class="address-card">
                                    <div class="account-address-box">
                                        <h6 class="mb-3">
                                            {{ \App\Models\ClientAddress::TYPE_SELECT[$type] ?? ucfirst($type) }}
                                            @if($address->nickname)
                                                <small class="text-muted">({{ $address->nickname }})</small>
                                            @endif
                                            @if($address->is_primary)<span class="badge bg-primary ms-2">Primary</span>@endif
                                        </h6>
                                        <ul>
                                            @if($address->label)
                                            <li><strong>{{ $address->label }}</strong></li>
                                            @endif
                                            @if($address->contact_name)
                                            <li>{{ $address->contact_name }}</li>
                                            @endif
                                            <li>{{ $address->address_line_1 }}</li>
                                            @if($address->address_line_2)
                                            <li>{{ $address->address_line_2 }}</li>
                                            @endif
                                            <li>{{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}</li>
                                            @if($address->contact_phone)
                                            <li>Phone: {{ $address->contact_phone }}</li>
                                            @endif
                                            @if($address->contact_email)
                                            <li>Email: {{ $address->contact_email }}</li>
                                            @endif
                                            @if($address->google_map_link)
                                            <li><a href="{{ $address->google_map_link }}" target="_blank" class="text-primary"><i class="fa-solid fa-map-location-dot me-1"></i>View on Map</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="account-address-bottom">
                                        <a href="{{ route('site.account.addresses.edit', $address) }}" class="d-block me-3"><i class="fa-solid fa-pen me-2"></i>Edit</a>
                                        <form action="{{ route('site.account.addresses.delete', $address) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this address?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="d-block me-3 btn-link" style="border: none; background: none; padding: 0; color: inherit; cursor: pointer;"><i class="fa-solid fa-trash-can me-2"></i>Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endforeach
                    @endif
                    
                    <div class="col-12">
                        <div class="account-card-add">
                            <div class="account-address-add">
                                <svg id="Line" height="50" viewBox="0 0 64 64" width="50" xmlns="http://www.w3.org/2000/svg"><path d="m59.28775 26.0578-7.30176-6.251v-11.72068a.99973.99973 0 0 0 -1-1h-7.46a.99974.99974 0 0 0 -1 1v3.60693l-7.2109-6.17675a5.07688 5.07688 0 0 0 -6.6416 0l-23.97314 20.54345a2.04251 2.04251 0 0 0 1.32226 3.56787h5.98047v18.92188a8.60569 8.60569 0 0 0 8.59082 8.60059h10.481a1.00019 1.00019 0 0 0 -.00006-2h-10.48094a6.60308 6.60308 0 0 1 -6.59082-6.60059v-19.92188a1.00005 1.00005 0 0 0 -1-1l-6.99951-.05078 23.97119-20.542a3.08781 3.08781 0 0 1 4.03955 0l8.86133 7.59082a1.00655 1.00655 0 0 0 1.65039-.75934v-4.7802h5.46v11.18066a1.00013 1.00013 0 0 0 .34961.75928l7.63184 6.60156h-6.98148a.99974.99974 0 0 0 -1 1v3.7002a1.00019 1.00019 0 0 0 2-.00006v-2.70014h5.98145a2.03152 2.03152 0 0 0 1.32031-3.56982z"/><path d="m43.99564 33.718a13.00122 13.00122 0 0 0 .00012 26.00244c17.24786-.71391 17.24231-25.29106-.00012-26.00244zm.00012 24.00244c-14.59461-.60394-14.58984-21.40082.00006-22.00244a11.00122 11.00122 0 0 1 -.00006 22.00244z"/><path d="m49.001 45.71942h-4v-4.00049a1.00019 1.00019 0 0 0 -2 0v4.00049h-4a1.00019 1.00019 0 0 0 .00006 2h3.99994v4a1 1 0 0 0 2 0v-4h4a1 1 0 0 0 0-2z"/></svg>
                            </div>
                            <h4 class="mb-3">Add New Address</h4>
                            <a href="{{ route('site.account.addresses.create') }}" class="btn btn-primary px-5">Add</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
