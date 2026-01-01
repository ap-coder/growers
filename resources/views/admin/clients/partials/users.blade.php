<div class="card card-outline card-info mt-4">
    <div class="card-header">
        <h6 class="mb-0"><i class="fas fa-users mr-2"></i> Associated Users</h6>
    </div>
    <div class="card-body">
        @if(isset($client) && $client->users->count() > 0)
            <table class="table table-sm table-bordered mb-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th width="100">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($client->users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->verified)
                                    <span class="badge badge-success">Verified</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-xs btn-danger remove-user-btn" data-user-id="{{ $user->id }}">
                                    <i class="fas fa-unlink"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted mb-3">No users associated with this client yet.</p>
        @endif

        <hr>
        <h6 class="mb-3">Add User to Client</h6>
        
        <ul class="nav nav-tabs" id="userTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="existing-user-tab" data-toggle="tab" href="#existing-user" role="tab">Select Existing User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="new-user-tab" data-toggle="tab" href="#new-user" role="tab">Create New User</a>
            </li>
        </ul>
        
        <div class="tab-content pt-3" id="userTabsContent">
            <div class="tab-pane fade show active" id="existing-user" role="tabpanel">
                <div class="row">
                    <div class="col-md-8">
                        <select class="form-control select2" id="existing_user_id" name="existing_user_id">
                            <option value="">-- Select a user --</option>
                            @foreach($availableUsers ?? [] as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-info btn-block" id="associate-user-btn">
                            <i class="fas fa-link mr-1"></i> Associate
                        </button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="new-user" role="tabpanel">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="new_user_name" name="new_user_name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="new_user_email" name="new_user_email">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="new_user_password" name="new_user_password">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success" id="create-user-btn">
                    <i class="fas fa-user-plus mr-1"></i> Create & Associate User
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(function() {
    var clientId = {{ $client->id ?? 'null' }};
    
    // Associate existing user
    $('#associate-user-btn').on('click', function() {
        var userId = $('#existing_user_id').val();
        if (!userId) {
            alert('Please select a user');
            return;
        }
        
        $.ajax({
            url: '/admin/clients/' + clientId + '/associate-user',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userId
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.message || 'Error associating user');
                }
            },
            error: function(xhr) {
                alert(xhr.responseJSON?.message || 'Error associating user');
            }
        });
    });
    
    // Create new user
    $('#create-user-btn').on('click', function() {
        var name = $('#new_user_name').val();
        var email = $('#new_user_email').val();
        var password = $('#new_user_password').val();
        
        if (!name || !email || !password) {
            alert('Please fill in all fields');
            return;
        }
        
        $.ajax({
            url: '/admin/clients/' + clientId + '/create-user',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: name,
                email: email,
                password: password
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.message || 'Error creating user');
                }
            },
            error: function(xhr) {
                alert(xhr.responseJSON?.message || 'Error creating user');
            }
        });
    });
    
    // Remove user association
    $('.remove-user-btn').on('click', function() {
        if (!confirm('Remove this user from the client?')) return;
        
        var userId = $(this).data('user-id');
        
        $.ajax({
            url: '/admin/clients/' + clientId + '/remove-user',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userId
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.message || 'Error removing user');
                }
            },
            error: function(xhr) {
                alert(xhr.responseJSON?.message || 'Error removing user');
            }
        });
    });
});
</script>
@endpush
