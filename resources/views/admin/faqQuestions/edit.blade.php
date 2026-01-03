@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit mr-2"></i> {{ trans('global.edit') }} {{ trans('cruds.faqQuestion.title_singular') }}</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.faq-questions.update", [$faqQuestion->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            {{-- Display Options --}}
            <div class="card card-outline card-secondary mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-eye mr-1"></i> Display Options</h6>
                </div>
                <div class="card-body py-2">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="icheck-success">
                                <input type="hidden" name="published" value="0">
                                <input type="checkbox" name="published" id="published" value="1" {{ $faqQuestion->published || old('published', 0) === 1 ? 'checked' : '' }}>
                                <label for="published">{{ trans('cruds.faqQuestion.fields.published') }}</label>
                            </div>
                            <small class="text-muted">Visible on site</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Settings --}}
            <div class="card card-outline card-info mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-cog mr-1"></i> Settings</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="required" for="category_id">{{ trans('cruds.faqQuestion.fields.category') }}</label>
                        <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required style="width: 100%;">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $id => $entry)
                                <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $faqQuestion->category_id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category'))
                            <span class="text-danger">{{ $errors->first('category') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Question Details --}}
            <div class="card card-outline card-success mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-question-circle mr-1"></i> Question Details</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="required" for="question">{{ trans('cruds.faqQuestion.fields.question') }}</label>
                        <textarea class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}" name="question" id="question" rows="2" required>{{ old('question', $faqQuestion->question) }}</textarea>
                        @if($errors->has('question'))
                            <span class="text-danger">{{ $errors->first('question') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-0">
                        <label class="required" for="answer">{{ trans('cruds.faqQuestion.fields.answer') }}</label>
                        <textarea class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer" id="answer" rows="4" required>{{ old('answer', $faqQuestion->answer) }}</textarea>
                        @if($errors->has('answer'))
                            <span class="text-danger">{{ $errors->first('answer') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-save mr-1"></i> {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.faq-questions.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$(document).ready(function() {
    $('#category_id').select2({
        placeholder: '-- Select Category --',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endsection