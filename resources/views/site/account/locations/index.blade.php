@extends('site.layouts.app')

@section('title', 'Locations - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.dashboard') }}">Account</a></li>
                    <li class="breadcrumb-item">Locations</li>
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
                <div class="account-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="title mb-0">Locations</h4>
                        <a href="{{ route('site.account.locations.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Add Location
                        </a>
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
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">
                                {{ \App\Models\ClientAddress::TYPE_SELECT[$type] ?? ucfirst($type) }}
                            </h5>
                            
                            <div class="row">
                                @foreach($typeAddresses as $address)
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 {{ $address->is_primary ? 'border-primary' : '' }}">
                                        <div class="card-body">
                                            @if($address->is_primary)
                                            <span class="badge bg-primary float-end">Primary</span>
                                            @endif
                                            
                                            @if($address->label)
                                            <h6 class="card-title">{{ $address->label }}</h6>
                                            @endif
                                            
                                            <address class="mb-2">
                                                {{ $address->address_line_1 }}<br>
                                                @if($address->address_line_2)
                                                {{ $address->address_line_2 }}<br>
                                                @endif
                                                {{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}
                                                @if($address->country && $address->country !== 'USA')
                                                <br>{{ $address->country }}
                                                @endif
                                            </address>
                                            
                                            @if($address->contact_name || $address->contact_phone || $address->contact_email)
                                            <div class="small text-muted mb-2">
                                                @if($address->contact_name)
                                                <div><i class="fas fa-user me-1"></i> {{ $address->contact_name }}</div>
                                                @endif
                                                @if($address->contact_phone)
                                                <div><i class="fas fa-phone me-1"></i> {{ $address->contact_phone }}</div>
                                                @endif
                                                @if($address->contact_email)
                                                <div><i class="fas fa-envelope me-1"></i> {{ $address->contact_email }}</div>
                                                @endif
                                            </div>
                                            @endif
                                            
                                            @if($address->delivery_notes)
                                            <div class="small text-muted">
                                                <strong>Notes:</strong> {{ $address->delivery_notes }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="card-footer bg-transparent">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <a href="{{ route('site.account.locations.edit', $address) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    @if(!$address->is_primary)
                                                    <form action="{{ route('site.account.locations.setPrimary', $address) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                            Set Primary
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                                <form action="{{ route('site.account.locations.delete', $address) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this location?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No locations added yet.</p>
                        <a href="{{ route('site.account.locations.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Add Your First Location
                        </a>
                    </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
