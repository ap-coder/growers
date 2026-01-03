@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-plus mr-2"></i> {{ trans('global.create') }} {{ trans('cruds.contentPage.title_singular') }}</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.content-pages.store") }}" enctype="multipart/form-data">
            @csrf

            {{-- Display Options - Checkboxes at top --}}
            <div class="card card-outline card-secondary mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-eye mr-1"></i> Display Options</h6>
                </div>
                <div class="card-body py-2">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="icheck-success">
                                <input type="hidden" name="published" value="0">
                                <input type="checkbox" name="published" id="published" value="1" {{ old('published', 1) ? 'checked' : '' }}>
                                <label for="published">{{ trans('cruds.contentPage.fields.published') }}</label>
                            </div>
                            <small class="text-muted">Visible on site</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Settings - Selects --}}
            <div class="card card-outline card-info mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-cog mr-1"></i> Settings</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="page_type">Page Type</label>
                                <select class="form-control {{ $errors->has('page_type') ? 'is-invalid' : '' }}" name="page_type" id="page_type">
                                    @foreach($pageTypes as $key => $label)
                                        <option value="{{ $key }}" {{ old('page_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('page_type'))
                                    <span class="text-danger">{{ $errors->first('page_type') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="layout">Page Layout</label>
                                <select class="form-control {{ $errors->has('layout') ? 'is-invalid' : '' }}" name="layout" id="layout">
                                    @foreach(\App\Models\ContentPage::LAYOUT_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('layout', 'default') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('layout'))
                                    <span class="text-danger">{{ $errors->first('layout') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="client_id">Client (for client-specific pages)</label>
                                <select class="form-control select2 {{ $errors->has('client_id') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                                    @foreach($clients as $id => $name)
                                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('client_id'))
                                    <span class="text-danger">{{ $errors->first('client_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Categories & Tags --}}
            <div class="card card-outline card-primary mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-tags mr-1"></i> Categories & Tags</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categories">{{ trans('cruds.contentPage.fields.category') }}</label>
                                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                                    @foreach($categories as $id => $category)
                                        <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('categories'))
                                    <span class="text-danger">{{ $errors->first('categories') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tags">{{ trans('cruds.contentPage.fields.tag') }}</label>
                                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                                    @foreach($tags as $id => $tag)
                                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('tags'))
                                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Page Details - Title, Slug, Content --}}
            <div class="card card-outline card-success mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-info-circle mr-1"></i> Page Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="required" for="title">{{ trans('cruds.contentPage.fields.title') }}</label>
                                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                                @if($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slug">Slug (URL)</label>
                                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" placeholder="auto-generated if empty">
                                @if($errors->has('slug'))
                                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="excerpt">{{ trans('cruds.contentPage.fields.excerpt') }}</label>
                        <textarea class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" name="excerpt" id="excerpt" rows="2">{{ old('excerpt') }}</textarea>
                        @if($errors->has('excerpt'))
                            <span class="text-danger">{{ $errors->first('excerpt') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="page_text">{{ trans('cruds.contentPage.fields.page_text') }}</label>
                        <textarea class="form-control ckeditor {{ $errors->has('page_text') ? 'is-invalid' : '' }}" name="page_text" id="page_text">{!! old('page_text') !!}</textarea>
                        @if($errors->has('page_text'))
                            <span class="text-danger">{{ $errors->first('page_text') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="card card-outline card-warning mb-3">
                <div class="card-header py-2">
                    <h6 class="mb-0"><i class="fas fa-image mr-1"></i> Featured Image</h6>
                </div>
                <div class="card-body">
                    <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
                    </div>
                    @if($errors->has('featured_image'))
                        <span class="text-danger">{{ $errors->first('featured_image') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-arrow-right mr-1"></i> Next
                </button>
                <a href="{{ route('admin.content-pages.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.content-pages.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $contentPage->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.featuredImageDropzone = {
    url: '{{ route('admin.content-pages.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="featured_image"]').remove()
      $('form').append('<input type="hidden" name="featured_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="featured_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($contentPage) && $contentPage->featured_image)
      var file = {!! json_encode($contentPage->featured_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="featured_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection