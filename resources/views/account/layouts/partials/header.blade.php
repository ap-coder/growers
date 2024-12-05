<header class="site-header mo-left header">
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container-fluid clearfix d-lg-flex d-block">
                <div class="logo-header logo-dark me-md-5">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="logo"></a>
                </div>
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="header-nav w3menu navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <ul class="nav navbar-nav">
                        <li class="has-mega-menu sub-menu-down auto-width menu-left">
                            <a href="{{ url('/') }}"><span>Home</span></a>
                        </li>
                        <li class="has-mega-menu sub-menu-down">
                            <a href="{{ url('/shop') }}"><span>Shop</span></a>
                        </li>
                        <li class="has-mega-menu sub-menu-down auto-width">
                            <a href="{{ url('/blog') }}"><span>Blog</span></a>
                        </li>
                        <li class="has-mega-menu sub-menu-down">
                            <a href="{{ url('/portfolio') }}"><span>Portfolio</span></a>
                        </li>
                        <li class="has-mega-menu sub-menu-down wide-width">
                            <a href="{{ url('/pages') }}"><span>Pages</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
