<!-- Header Start -->
<header class="site-header mo-left header">
    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container-fluid clearfix d-lg-flex d-block">
                
                <!-- Website Logo -->
                <div class="logo-header logo-dark me-md-4 me-2">
                    <a href="{{ route('frontend.home') }}"><img src="{{ asset('site/images/logo.svg') }}" alt="Pacific Plant Growers"></a>
                </div>
                
                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <!-- Main Nav -->
                <div class="header-nav w3menu navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <div class="logo-header logo-dark">
                        <a href="{{ route('frontend.home') }}"><img src="{{ asset('site/images/logo.svg') }}" alt=""></a>
                    </div>
                    @php
                        $mainNavMenu = \App\Menu\Models\Menus::where('name', 'Main Navigation')->first();
                    @endphp
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route('frontend.home') }}"><span>Home</span></a>
                        </li>
                        <li>
                            <a href="{{ route('site.shop.index') }}"><span>Products</span></a>
                        </li>
                        @if($mainNavMenu && $mainNavMenu->items->count() > 0)
                            @foreach($mainNavMenu->items->where('parent', 0)->sortBy('sort') as $item)
                                <li>
                                    <a href="{{ $item->link }}"><span>{{ $item->label }}</span></a>
                                </li>
                            @endforeach
                        @endif
                        @auth
                            <li>
                                <a href="{{ route('site.account.orders') }}"><span>My Orders</span></a>
                            </li>
                        @endauth
                    </ul>
                </div>
                
                <!-- Extra Nav -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <ul class="header-right">
                            @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <i class="flaticon flaticon-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('site.account.dashboard') }}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('site.account.profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('site.account.orders') }}">Orders</a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="flaticon flaticon-user"></i> Login
                                </a>
                            </li>
                            @endauth
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('site.cart') }}">
                                    <i class="flaticon flaticon-shopping-cart-1"></i>
                                    <span class="badge badge-circle">{{ session('cart_count', 0) }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
