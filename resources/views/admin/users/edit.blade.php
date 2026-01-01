@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            {{-- Checkboxes Row --}}
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="approved" value="0">
                            <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1" {{ $user->approved || old('approved', 0) === 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="approved">{{ trans('cruds.user.fields.approved') }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="form-check {{ $errors->has('needs_setup') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="needs_setup" value="0">
                            <input class="form-check-input" type="checkbox" name="needs_setup" id="needs_setup" value="1" {{ $user->needs_setup || old('needs_setup', 0) === 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="needs_setup">Needs Site Setup</label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Select Fields Row --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                        <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                            @foreach($roles as $id => $role)
                                <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('roles'))
                            <span class="text-danger">{{ $errors->first('roles') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="team_id">{{ trans('cruds.user.fields.team') }}</label>
                        <select class="form-control select2 {{ $errors->has('team') ? 'is-invalid' : '' }}" name="team_id" id="team_id">
                            @foreach($teams as $id => $entry)
                                <option value="{{ $id }}" {{ (old('team_id') ? old('team_id') : $user->team->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('team'))
                            <span class="text-danger">{{ $errors->first('team') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="client_id">Client</label>
                        <select class="form-control select2 {{ $errors->has('client_id') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                            @foreach($clients as $id => $entry)
                                <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $user->client_id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('client_id'))
                            <span class="text-danger">{{ $errors->first('client_id') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Text Inputs Row 1 --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Text Inputs Row 2 --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                        @if($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection