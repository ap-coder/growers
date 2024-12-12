<header class="site-header mo-left header">		
    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container-fluid clearfix d-lg-flex d-block bg-light">
                
                <!-- Website Logo -->
                <div class="logo-header logo-dark me-md-5">
                    <a href="{{ route('homepage') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="logo"></a>
                </div>
                
                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <!-- Main Nav -->
                <div class="header-nav w3menu navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route('homepage') }}"><span>Home</span></a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}"><span>About</span></a>
                        </li>
                        <li>
                            <a href="{{ route('what_we_do') }}"><span>What We Do</span></a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}"><span>Contact</span></a>
                        </li>
                    </ul>
                </div>
                
                <!-- Extra Navigation -->
                <div class="extra-nav">
                    <ul class="header-right">
                        <li class="nav-item login-link">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item register-link">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Header End -->
</header>
