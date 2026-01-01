@extends('site.layouts.app')

@section('title', 'Messages - Pacific Plant Growers')

@section('banner')
<div class="dz-bnr-inr" style="background-image:url({{ asset('site/images/background/bg1.jpg') }});">
    <div class="container">
        <div class="dz-bnr-inr-entry">
            <nav aria-label="breadcrumb" class="breadcrumb-row">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('site.account.dashboard') }}">Account</a></li>
                    <li class="breadcrumb-item">Messages</li>
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
                        <h4 class="mb-0">Messages</h4>
                        <a href="{{ route('site.account.messages.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> New Message
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($topics->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>With</th>
                                        <th>Last Message</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topics as $topic)
                                        @php
                                            $otherUser = $topic->receiverOrCreator();
                                            $hasUnread = $topic->hasUnreads();
                                            $lastMessage = $topic->messages->first();
                                        @endphp
                                        <tr class="{{ $hasUnread ? 'table-warning' : '' }}">
                                            <td>
                                                <strong>{{ $topic->subject }}</strong>
                                                @if($hasUnread)
                                                    <span class="badge bg-danger ms-1">New</span>
                                                @endif
                                            </td>
                                            <td>{{ $otherUser->name ?? 'Unknown' }}</td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $lastMessage ? $lastMessage->created_at->diffForHumans() : $topic->created_at->diffForHumans() }}
                                                </small>
                                            </td>
                                            <td>
                                                @if($hasUnread)
                                                    <span class="badge bg-warning text-dark">Unread</span>
                                                @else
                                                    <span class="badge bg-secondary">Read</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('site.account.messages.show', $topic->id) }}" class="btn btn-sm btn-outline-primary">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-envelope-open-text fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No messages yet.</p>
                            <a href="{{ route('site.account.messages.create') }}" class="btn btn-primary">
                                Send Your First Message
                            </a>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
