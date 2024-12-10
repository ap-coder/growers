// resources/views/account/layouts/partials/sidebar.blade.php

<div class="account-sidebar-wrapper">
    <div class="account-sidebar" id="accountSidebar">
        <div class="profile-head">
            <div class="user-thumb">
                <img class="rounded-circle" src="{{ asset('assets/images/profile4.jpg') }}" alt="User Profile">
            </div>
            <h5 class="title mb-0">Ronald M. Spino</h5>
            <span class="text text-primary">info@example.com</span>
        </div>
        <div class="account-nav">
            <div class="nav-title bg-light">DASHBOARD</div>
            <ul>
                <li><a href="{{ url('/account/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('/account/orders') }}">Orders</a></li>
                <li><a href="{{ url('/account/downloads') }}">Downloads</a></li>
                <li><a href="{{ url('/account/return-request') }}">Return request</a></li>
            </ul>
            <div class="nav-title bg-light">ACCOUNT SETTINGS</div>
            <ul class="account-info-list">
                <li><a href="{{ url('/account/profile') }}">Profile</a></li>
                <li><a href="{{ url('/account/address') }}">Address</a></li>
                <li><a href="{{ url('/account/shipping-methods') }}">Shipping methods</a></li>
                <li><a href="{{ url('/account/payment-methods') }}">Payment Methods</a></li>
                <li><a href="{{ url('/account/review') }}">Review</a></li>
            </ul>
        </div>
    </div>
</div>
