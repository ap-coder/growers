<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Pacific Plant Growers</title>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- FAVICONS ICON -->
    <link rel="icon" type="image/x-icon" href="{{ asset('site/images/favicon.png') }}">
    
    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('site/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('site/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('site/vendor/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('site/vendor/animate/animate.css') }}">
    
    <!-- Custom Stylesheet -->
    <link class="main-css" rel="stylesheet" type="text/css" href="{{ asset('site/css/style.css') }}">
    <link class="skin" type="text/css" rel="stylesheet" href="{{ asset('site/css/skin/skin-1.css') }}">
    
    <!-- GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
</head>
<body>
<div class="page-wraper">
    <div id="loading-area" class="loading-page-1">
        <div class="text"><span class="text-primary">Pacific</span> Plant Growers</div>
    </div>

    <div class="page-content">
        <section class="px-3">
            <div class="row align-center-center">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 p-a0">
                    <div class="login-slider">
                        @php
                            $loginBg = \App\Models\Setting::get('login_background_image');
                            $loginBgUrl = $loginBg ? asset('storage/' . $loginBg) : asset('site/images/registration/pic2.jpg');
                        @endphp
                        <div class="banner-login" style="background-image: url({{ $loginBgUrl }})">
                            <div class="banner-content">
                                <h4 class="sub-title">Log in</h4>
                                <h2 class="title">Welcome Back</h2>
                                <p class="text">Sign back in to your account to access your orders and manage your wholesale plant purchases.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 end-side-content">
                    <div class="login-area">
                        <h2 class="login-head mb-1">Sign in</h2>
                        <p>Please enter your details to sign in</p>
                        
                        @if(session()->has('message'))
                            <div class="alert alert-info">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <a href="{{ route('register') }}" class="btn google-btn w-100 mb-3">
                                <i class="fas fa-user-plus me-2"></i> Create an Account
                            </a>
                            
                            <h6 class="login-title"><span>or sign in with email</span></h6>
                            
                            <div class="col-12">
                                <div class="m-b25">
                                    <label class="label-title">Email Address</label>
                                    <input name="email" required class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Email Address" type="email" value="{{ old('email') }}" autofocus>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="m-b10">
                                    <label class="label-title">Password</label>
                                    <div class="dz-search-password">
                                        <input name="password" required class="form-control dz-password {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Password" type="password">
                                        @if($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                        <div class="show-pass">
                                            <svg class="eye-close" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#8ea5c8"><path d="M11 17.188a8.71 8.71 0 0 1-1.576-.147.69.69 0 0 1-.579-.678.7.7 0 0 1 .817-.676 7.33 7.33 0 0 0 1.339.127c4.073 0 7.61-3.566 8.722-4.812a18.51 18.51 0 0 0-2.434-2.274.69.69 0 0 1 .335-1.226.69.69 0 0 1 .268.019c.087.024.169.064.24.12a18.79 18.79 0 0 1 3.036 2.939.69.69 0 0 1 0 .848c-.185.234-4.581 5.763-10.167 5.763zm7.361-13.549a.69.69 0 0 0-.972 0l-2.186 2.186a10.68 10.68 0 0 0-2.606-.864c-.527-.099-1.061-.149-1.597-.149-5.585 0-9.982 5.528-10.166 5.763a.69.69 0 0 0 0 .848c.897 1.09 1.915 2.075 3.033 2.936.529.415 1.083.796 1.66 1.142l-1.888 1.887c-.066.063-.118.139-.154.223a.69.69 0 0 0 .145.757.67.67 0 0 0 .226.15c.085.034.175.052.266.051a.69.69 0 0 0 .265-.056c.084-.036.16-.088.223-.154l13.75-13.75a.69.69 0 0 0 0-.972zm-13.65 9.636A18.51 18.51 0 0 1 2.278 11C3.39 9.754 6.927 6.187 11 6.187a7.31 7.31 0 0 1 1.348.127 8.92 8.92 0 0 1 1.814.55L12.895 8.13c-.661-.437-1.453-.632-2.241-.552a3.44 3.44 0 0 0-2.085.989c-.56.56-.91 1.297-.989 2.085a3.44 3.44 0 0 0 .552 2.241l-1.601 1.604a14.43 14.43 0 0 1-1.82-1.222zm4.432-1.392c-.134-.275-.204-.577-.206-.883a2.07 2.07 0 0 1 .6-1.456 2.12 2.12 0 0 1 2.338-.392l-2.731 2.731z"></path></svg>
                                            <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#8ea5c8"><path d="M19.873 9.611c-.179-.244-4.436-5.985-9.873-5.985S.305 9.367.127 9.611a.66.66 0 0 0 0 .778c.178.244 4.436 5.985 9.873 5.985s9.694-5.74 9.873-5.984a.66.66 0 0 0 0-.778zM10 15.055c-4.005 0-7.474-3.81-8.501-5.055C2.525 8.753 5.986 4.945 10 4.945c4.005 0 7.473 3.809 8.501 5.055-1.025 1.247-4.487 5.054-8.501 5.054zm0-9.011A3.96 3.96 0 0 0 6.044 10 3.96 3.96 0 0 0 10 13.956 3.96 3.96 0 0 0 13.956 10 3.96 3.96 0 0 0 10 6.044zm0 6.593A2.64 2.64 0 0 1 7.363 10 2.64 2.64 0 0 1 10 7.363 2.64 2.64 0 0 1 12.637 10 2.64 2.64 0 0 1 10 12.637z"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row d-flex justify-content-between m-b30">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if(Route::has('password.request'))
                                        <a class="text-primary btn-border btn-link" href="{{ route('password.request') }}">Forgot Password</a>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <button type="submit" class="btn btn-secondary btn-lg w-100 btnhover">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>
</div>

<!-- JAVASCRIPT FILES -->
<script src="{{ asset('site/js/jquery.min.js') }}"></script>
<script src="{{ asset('site/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('site/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('site/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('site/js/custom.js') }}?v={{ time() }}"></script>
</body>
</html>