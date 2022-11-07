@extends('admin.layouts.app')
@section('content')
    <div class="card w-50 mx-auto mt-5">
        <div class="card-body">
            <h5 class="text-primary">Create an Event</h5>
            <hr />
            <form action="{{route('event.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Event Title</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid  @enderror" id="ETitle">
                     @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Event Date</label>
                    <input type="datetime-local" name="edate" value="{{old('edate')}}" class="form-control @error('edate') is-invalid  @enderror" id="date">
                    @error('edate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Picture</label>
                    <input type="file" name="epic" class="form-control @error('epic') is-invalid  @enderror" id="img">
                    @error('epic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Event Details</label>
                    <textarea name="edetail" id="editor"  class="form-control">{{old('edetail')}}</textarea>
                   @error('edetail')
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
