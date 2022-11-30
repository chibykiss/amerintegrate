@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-lg-8 col-sm-12 mx-auto mt-5">
                <div class="card-body">
                    <h5 class="text-primary">Create a Team Member</h5>
                    <hr />
                    <form action="{{ route('team.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Member Name</label>
                            <input type="text" name="member_name" value="{{ old('member_name') }}"
                                class="form-control @error('title') is-invalid  @enderror" id="ETitle">
                            @error('member_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="mb-3">
                            <label for="title" class="form-label">Member Position</label>
                            <input type="text" name="position" value="{{ old('position') }}"
                                class="form-control @error('title') is-invalid  @enderror" id="ETitle">
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                 
                        <div class="mb-3">
                            <label for="title" class="form-label">Member Picture</label>
                            <input type="file" name="tpic" class="form-control @error('tpic') is-invalid  @enderror"
                                id="img">
                            @error('tpic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="mb-2">
                            <label for="title" class="form-label">Facebook</label>
                            <input type="text" name="facebook" value="{{ old('facebook') }}"
                                class="form-control @error('facebook') is-invalid  @enderror" id="ETitle">
                            @error('facebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                            <div class="mb-2">
                            <label for="title" class="form-label">Twitter</label>
                            <input type="text" name="twitter" value="{{ old('twitter') }}"
                                class="form-control @error('twitter') is-invalid  @enderror" id="ETitle">
                            @error('twitter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                            <div class="mb-3">
                            <label for="title" class="form-label">Linkedin</label>
                            <input type="text" name="linkedin" value="{{ old('linkedin') }}"
                                class="form-control @error('linkedin') is-invalid  @enderror" id="ETitle">
                            @error('linkedin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">About Member</label>
                            <textarea name="description" id="editor" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
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
