@extends('admin.layouts.app')
@section('content')
    
    <div class="card w-50 mx-auto mt-5">
        <div class="card-body">
            @include('admin.incs.alert')
            <h5 class="modal-title text-primary">Send Email</h5>
            <hr />
            <form action="{{ route('email.send') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Email</label>
                    <input type="text" name="reciever" class="form-control @error('reciever') is-invalid  @enderror"
                        id="reciever" value="{{ $mail }}">
                    @error('reciever')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control @error('subject') is-invalid  @enderror"
                        id="subject" value="{{ old('subject') }}">
                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Send Through</label>
                    <select id="platform" name="via" class="form-select @error('via') is-invalid  @enderror"
                        aria-label="Default select example">
                        <option value="info@amrintegrate.com">info@amrintegrate.com</option>
                        <option value="no-reply@amarintegrate.com">no-reply@amarintegrate.com</option>
                    </select>
                    @error('via')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="post-body" class="form-label">Email body</label>
                    <textarea class="form-control @error('emailbody') is-invalid  @enderror" name="emailbody" id="editor" rows="4"
                        cols="50">{{ old('emailbody') }}</textarea>
                    @error('emailbody')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="form-control bg-primary text-white">SEND EMAIL</button>
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
