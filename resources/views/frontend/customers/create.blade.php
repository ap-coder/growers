@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.customer.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.customers.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="company_name">{{ trans('cruds.customer.fields.company_name') }}</label>
                            <input class="form-control" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}">
                            @if($errors->has('company_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.customer.fields.company_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_person_id">{{ trans('cruds.customer.fields.contact_person') }}</label>
                            <select class="form-control select2" name="contact_person_id" id="contact_person_id">
                                @foreach($contact_people as $id => $entry)
                                    <option value="{{ $id }}" {{ old('contact_person_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('contact_person'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_person') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.customer.fields.contact_person_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection