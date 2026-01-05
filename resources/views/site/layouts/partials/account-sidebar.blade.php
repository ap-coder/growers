@php
    $unreadMessages = \App\Models\QaTopic::where(function ($query) {
        $query->where('creator_id', auth()->id())
              ->orWhere('receiver_id', auth()->id());
    })->with('messages')->get()->sum(function($topic) {
        return $topic->messages->where('sender_id', '!=', auth()->id())->whereNull('read_at')->count();
    });
@endphp
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
                    <li><a href="{{ route('site.account.orders') }}" class="{{ request()->routeIs('site.account.orders') ? 'active' : '' }}">Orders</a></li>
                    <li><a href="{{ route('site.account.order-history') }}" class="{{ request()->routeIs('site.account.order-history') ? 'active' : '' }}">Order History</a></li>
                    <li>
                        <a href="{{ route('site.account.messages.index') }}" class="{{ request()->routeIs('site.account.messages*') ? 'active' : '' }}">
                            Messages
                            @if($unreadMessages > 0)
                                <span class="badge bg-danger rounded-pill ms-1">{{ $unreadMessages }}</span>
                            @endif
                        </a>
                    </li>
                    <li><a href="{{ route('site.account.profile') }}" class="{{ request()->routeIs('site.account.profile') ? 'active' : '' }}">Profile</a></li>
                </ul>
                <div class="nav-title bg-light">ACCOUNT SETTINGS</div>
                <ul class="account-info-list">
                    @if(auth()->user()->client)
                    <li><a href="{{ route('site.account.company') }}" class="{{ request()->routeIs('site.account.company') ? 'active' : '' }}">Company Info</a></li>
                    <li><a href="{{ route('site.account.addresses') }}" class="{{ request()->routeIs('site.account.addresses*') ? 'active' : '' }}">Addresses</a></li>
                    @endif
                </ul>
                <div class="nav-title bg-light">HELP</div>
                <ul class="account-info-list">
                    <li><a href="{{ route('site.how-to-order') }}">How to Order</a></li>
                </ul>
                @if(auth()->user()->isWclDeveloper || session()->has('impersonate_original_user_id'))
                <div class="nav-title bg-light">DEVELOPER TOOLS</div>
                <ul class="account-info-list">
                    @if(session()->has('impersonate_original_user_id'))
                    <li>
                        <form action="{{ route('admin.impersonate.stop') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                <i class="fas fa-user-slash"></i> Stop Impersonating
                            </button>
                        </form>
                    </li>
                    @else
                    <li>
                        <select id="impersonateUserSelect" class="form-select form-select-sm">
                            <option value="">Switch to User...</option>
                        </select>
                    </li>
                    @endif
                </ul>
                @endif
            </div>
        </div>
    </div>
</aside>

@if(auth()->user()->isWclDeveloper && !session()->has('impersonate_original_user_id'))
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('impersonateUserSelect');
    if (!select) return;
    
    // Load users
    fetch('{{ route('admin.impersonate.users') }}')
        .then(response => response.json())
        .then(users => {
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = `${user.name} (${user.client_name})`;
                select.appendChild(option);
            });
        });
    
    // Handle selection
    select.addEventListener('change', function() {
        if (this.value) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/users/${this.value}/impersonate`;
            
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            
            document.body.appendChild(form);
            form.submit();
        }
    });
});
</script>
@endpush
@endif
