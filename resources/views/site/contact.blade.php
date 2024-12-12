@extends('site.layouts.site')

@section('title', 'Contact Us')

@section('content')
<div class="container">
    <div class="contact-section py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4 text-center">Get in Touch with Us</h1>
                <p class="text-center mb-5">Have questions or need help? We would love to hear from you! Feel free to reach out to us and we will get back to you as soon as possible.</p>
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
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection