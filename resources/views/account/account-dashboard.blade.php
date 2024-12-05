@extends('account.layouts.account')

@section('title', 'Account Dashboard')

@section('content')
<div class="container">
    <div class="content-inner-1">
        <div class="row">
            <aside class="col-xl-3">
                @include('account.layouts.partials.sidebar')
            </aside>
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <div class="m-b30">
                        <p>Hello <strong class="text-black">John Doe</strong> (not <strong class="text-black">John Doe</strong>? <a href="{{ url('/logout') }}" class="text-underline">Log out</a>)</p>
                        <p>From your account dashboard you can view your <a href="{{ url('/account/orders') }}" class="text-underline">recent orders</a>, manage your <a href="{{ url('/account/address') }}" class="text-underline">shipping and billing addresses</a>, and <a href="{{ url('/account/profile') }}" class="text-underline">edit your password and account details</a>.</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="total-contain">
                                <div class="total-icon">
                                    <svg width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M32.4473 8.03086C32.482 8.37876..." fill="#FFBB38"></path>
                                    </svg>
                                </div>
                                <div class="total-detail">
                                    <span class="text">Total Order</span>
                                    <h2 class="title">3658</h2>
                                </div>
                            </div>
                        </div>
                        <!-- Additional cards as needed -->
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
