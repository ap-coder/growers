<aside class="col-xl-3">
    <div class="toggle-info">
        <h5 class="title mb-0">Account Navbar</h5>
        <a class="toggle-btn" href="#accountSidebar">Account Menu</a>
    </div>
    <div class="account-sidebar-wrapper">
        <div class="account-sidebar" id="accountSidebar">
            <div class="profile-head">
                <div class="user-thumb">
                    <img class="rounded-circle" src="{{ asset('site/images/profile4.jpg') }}" alt="{{ auth()->user()->name }}">
                </div>
                <h5 class="title mb-0">{{ auth()->user()->name }}</h5>
                <span class="text text-primary">{{ auth()->user()->email }}</span>
            </div>
            <div class="account-nav">
                <div class="nav-title bg-light">DASHBOARD</div>
                <ul>
                    <li><a href="{{ route('site.account.dashboard') }}" class="{{ request()->routeIs('site.account.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                    <li><a href="{{ route('site.account.orders') }}" class="{{ request()->routeIs('site.account.orders*') ? 'active' : '' }}">Orders</a></li>
                </ul>
                <div class="nav-title bg-light">ACCOUNT SETTINGS</div>
                <ul class="account-info-list">
                    <li><a href="{{ route('site.account.profile') }}" class="{{ request()->routeIs('site.account.profile') ? 'active' : '' }}">Profile</a></li>
                </ul>
                <div class="nav-title bg-light">HELP</div>
                <ul class="account-info-list">
                    <li><a href="{{ route('site.how-to-order') }}">How to Order</a></li>
                </ul>
            </div>
        </div>
    </div>
</aside>
