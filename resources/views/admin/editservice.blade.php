@extends('admin.layouts.app')
@section('content')
    <div class="card w-50 mx-auto mt-5">
        <div class="card-body">
            <h5 class="text-primary">Edit Service</h5>
            <hr />
            <form action="{{route('service.update', ['service' => $service->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Service Title</label>
                    <input type="text" name="title" value="{{$service->name}}" class="form-control @error('title') is-invalid  @enderror" id="ETitle">
                     @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              
                <div class="mb-3">
                   <label for="image" class="form-label">Old Service image</label> 
                   <img class="img-thumbnail" src="{{asset('storage/service_pic/'.$service->picture)}}"/>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Picture</label>
                    <input type="file" name="spic" class="form-control @error('spic') is-invalid  @enderror" id="img">
                    @error('spic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Event Details</label>
                    <textarea name="content" id="editor"  class="form-control">{{$service->content}}</textarea>
                   @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="form-control btn-primary">Update Service</button>
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
