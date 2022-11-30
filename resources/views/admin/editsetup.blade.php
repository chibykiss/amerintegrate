@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-lg-8 col-sm-12 mx-auto mt-5">
                <div class="card-body">
                    <h5 class="text-primary">Edit Website Setups</h5>
                    <hr />
                    <form action="{{ route('setup.update', ['setup' => $setup->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Website Address</label>
                            <input type="text" name="address" value="{{ $setup->website_address }}"
                                class="form-control @error('address') is-invalid  @enderror" id="ETitle">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
               
                         <div class="mb-3">
                            <button type="submit" class="form-control btn-primary">Update Website Setup</button>
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
