@extends('site.layouts.app')

@section('title', 'My Profile - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.dashboard') }}">Account</a></li>
                    <li class="breadcrumb-item">Profile</li>
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
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="profile-edit mb-4">
                        <div class="avatar-upload d-flex align-items-center">
                            <div class="position-relative">
                                <div class="avatar-preview thumb">
                                    <div id="imagePreview" style="background-image: url({{ auth()->user()->avatar ?? asset('site/images/profile3.jpg') }}); width: 100px; height: 100px; border-radius: 50%; background-size: cover; background-position: center;"></div>
                                </div>
                                <div class="change-btn thumb-edit d-flex align-items-center flex-wrap mt-2">
                                    <input type="file" class="form-control d-none" id="imageUpload" accept=".png, .jpg, .jpeg">
                                    <label for="imageUpload" class="btn btn-light btn-sm ms-0"><i class="fa-solid fa-camera"></i> Change Photo</label>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix mt-3">
                            <h2 class="title mb-0">{{ auth()->user()->name }}</h2>
                            <span class="text text-primary">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('site.account.profile.update') }}" class="row">
                        @csrf
                        
                        <div class="col-lg-6">
                            <div class="form-group m-b25">
                                <label class="label-title">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name', auth()->user()->first_name ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group m-b25">
                                <label class="label-title">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', auth()->user()->last_name ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group m-b25">
                                <label class="label-title">Email Address</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group m-b25">
                                <label class="label-title">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group m-b25">
                                <label class="label-title">New Password (leave blank to leave unchanged)</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group m-b25">
                                <label class="label-title">Confirm New Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox text-black">
                                        <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter" value="1" {{ old('newsletter', auth()->user()->newsletter ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="newsletter">Subscribe me to Newsletter</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-3 mt-sm-0" type="submit">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
