@extends('admin.layouts.app')
@section('content')
    <div class="card w-50 mx-auto mt-5">
        <div class="card-body">
            <h5 class="text-primary">Edit an Event</h5>
            <hr />
            <form action="{{route('event.update', ['event' => $event->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Event Title</label>
                    <input type="text" name="title" value="{{$event->title}}" class="form-control @error('title') is-invalid  @enderror" id="ETitle">
                     @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Event Date</label>
                    <input type="datetime-local" name="edate" value="{{$event->event_date}}" class="form-control @error('edate') is-invalid  @enderror" id="date">
                    @error('edate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                   <label for="image" class="form-label">Old Event image</label> 
                   <img class="img-thumbnail" src="{{asset('storage/images/event_pic/'.$event->event_pic)}}"/>
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
                    <textarea name="edetail" id="editor"  class="form-control">{{$event->event_detail}}</textarea>
                   @error('edetail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="form-control btn-primary">Update Event</button>
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
