@extends('layouts.app')
@section('content')
<div class="login-box" style="width: 450px;">
    <div class="login-logo">
        <div class="login-logo">
            <a href="#">
                {{ trans('panel.site_title') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ trans('global.register') }}</p>
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                @if(request()->has('team'))
                    <input type="hidden" name="team" id="team" value="{{ request()->query('team') }}">
                @endif
                <div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>

                    <hr>
                    <p class="text-muted small mb-2">Company / Client Association</p>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="client_option" id="client_existing" value="existing" {{ old('client_option', 'existing') == 'existing' ? 'checked' : '' }}>
                            <label class="form-check-label" for="client_existing">
                                Select existing company
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="client_option" id="client_new" value="new" {{ old('client_option') == 'new' ? 'checked' : '' }}>
                            <label class="form-check-label" for="client_new">
                                Register new company
                            </label>
                        </div>
                    </div>

                    <div class="form-group" id="existing_client_group">
                        <select name="client_id" class="form-control {{ $errors->has('client_id') ? 'is-invalid' : '' }}">
                            <option value="">-- Select your company --</option>
                            @foreach($clients ?? [] as $id => $name)
                                <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('client_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('client_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group" id="new_client_group" style="display: none;">
                        <input type="hidden" name="create_new_client" id="create_new_client" value="0">
                        <input type="text" name="new_client_name" class="form-control {{ $errors->has('new_client_name') ? 'is-invalid' : '' }}" placeholder="Enter company name" value="{{ old('new_client_name') }}">
                        @if($errors->has('new_client_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('new_client_name') }}
                            </div>
                        @endif
                        <small class="text-muted">New companies require admin approval before ordering.</small>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('global.register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var existingRadio = document.getElementById('client_existing');
    var newRadio = document.getElementById('client_new');
    var existingGroup = document.getElementById('existing_client_group');
    var newGroup = document.getElementById('new_client_group');
    var createNewInput = document.getElementById('create_new_client');

    function toggleClientFields() {
        if (newRadio.checked) {
            existingGroup.style.display = 'none';
            newGroup.style.display = 'block';
            createNewInput.value = '1';
        } else {
            existingGroup.style.display = 'block';
            newGroup.style.display = 'none';
            createNewInput.value = '0';
        }
    }

    existingRadio.addEventListener('change', toggleClientFields);
    newRadio.addEventListener('change', toggleClientFields);

    // Initialize on page load
    toggleClientFields();
});
</script>
@endsection