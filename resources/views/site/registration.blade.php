@extends('site.layouts.site')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="registration-section">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Create an Account</h2>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <div class="mt-4">
                    <p>Already have an account? <a href="{{ url('/login') }}">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
