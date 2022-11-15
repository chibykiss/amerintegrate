@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-lg-8 col-sm-12 mx-auto mt-5">
                <div class="card-body">
                    <h5 class="text-primary">Create an Faq</h5>
                    <hr />
                    <form action="{{ route('faq.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Question</label>
                            <input type="text" name="question" value="{{ old('question') }}"
                                class="form-control @error('question') is-invalid  @enderror" id="ETitle">
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Answer</label>
                            <textarea name="answer" id="editor" class="form-control">{{ old('answer') }}</textarea>
                            @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="submit" name="post_type" value="SAVE"
                                        class="form-control bg-primary text-white">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="submit" name="post_type" value="SAVE/PUBLISH"
                                        class="form-control bg-primary text-white">
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    // uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}'
                    uploadUrl: '{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}'
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
