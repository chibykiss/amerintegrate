@extends('admin.layouts.app')
@section('content')
<div class="container">
	<div class="row">
    <div class="card col-lg-8 col-sm-12 mx-auto mt-5">
        <div class="card-body">
            <h5 class="modal-title text-primary">Create a Post</h5>
            <hr />
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid  @enderror"
                        id="title" value="{{old('title')}}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Post image</label>
                     <input type="file" name="postpic" class="form-control @error('postpic') is-invalid  @enderror"
                        value="{{old('postpic')}}" id="image">
                    @error('postpic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="post-body" class="form-label">Post Body</label>
                    <textarea class="form-control @error('postbody') is-invalid  @enderror" name="postbody" id="editor" rows="4"
                        cols="50">{{old('postbody')}}</textarea>
                    @error('postbody')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="submit" name="post_type" value="SAVE" class="form-control bg-primary text-white">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="submit" name="post_type" value="SAVE/PUBLISH" class="form-control bg-primary text-white">
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
