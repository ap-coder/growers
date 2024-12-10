@extends('site.layouts.site')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="login-section">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Login to Your Account</h2>
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="{{ url('/password/reset') }}" class="d-block mt-3">Forgot your password?</a>
                </form>
                <div class="mt-4">
                    <p>Don't have an account? <a href="{{ url('/register') }}">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
