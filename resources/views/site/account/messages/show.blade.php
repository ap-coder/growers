@extends('site.layouts.app')

@section('title', '{{ $topic->subject }} - Messages - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.dashboard') }}">Account</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.messages.index') }}">Messages</a></li>
                    <li class="breadcrumb-item">{{ Str::limit($topic->subject, 30) }}</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-inner-1">
    <div class="container">
        <div class="row">
            @include('site.layouts.partials.account-sidebar')
            
            <section class="col-xl-9 account-wrapper">
                <div class="account-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <a href="{{ route('site.account.messages.index') }}" class="text-muted mb-2 d-inline-block">
                                <i class="fas fa-arrow-left me-1"></i> Back to Messages
                            </a>
                            <h4 class="mb-0">{{ $topic->subject }}</h4>
                            <small class="text-muted">
                                Conversation with {{ $topic->receiverOrCreator()->name ?? 'Unknown' }}
                            </small>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="messages-container mb-4" style="max-height: 400px; overflow-y: auto;">
                        @foreach($topic->messages->reverse() as $message)
                            @php
                                $isMe = $message->sender_id === auth()->id();
                            @endphp
                            <div class="message-item mb-3 p-3 rounded {{ $isMe ? 'bg-primary text-white ms-5' : 'bg-light me-5' }}">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <strong>{{ $isMe ? 'You' : ($message->sender->name ?? 'Unknown') }}</strong>
                                    <small class="{{ $isMe ? 'text-white-50' : 'text-muted' }}">
                                        {{ $message->created_at->format('M d, Y g:i A') }}
                                    </small>
                                </div>
                                <div class="message-content">
                                    {!! nl2br(e($message->content)) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr>

                    <h5>Reply</h5>
                    <form action="{{ route('site.account.messages.reply', $topic->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      name="content" rows="4" 
                                      placeholder="Type your reply..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-reply me-1"></i> Send Reply
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
