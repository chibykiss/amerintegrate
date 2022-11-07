@extends('admin.layouts.app')
@section('content')
    <div class="card w-50 mx-auto mt-5">
        <div class="card-body">
            <h5 class="modal-title text-primary">Add Video</h5>
            @include('admin.incs.alert')
            <hr />
            <form action="{{route('video.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Video Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid  @enderror" id="video">
                  @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Video Detail</label>
                    <textarea name="detail" id="editor" class="form-control @error('detail') is-invalid  @enderror">{{ old('edetail') }}</textarea>
                  @error('detail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div  class="mb-3">
                    <label for="title" class="form-label">Via</label>
                    <select id="platform" name="via" class="form-select @error('via') is-invalid  @enderror" aria-label="Default select example">
                        <option >Open this select menu</option>
                        <option value="youtube">youtube</option>
                        <option value="vimeo">vimeo</option>
                        <option value="manual" selected>Manual Upload</option>
                    </select>
                     @error('via')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                    <div style="display:none;" id="manual" class="mb-3">
                        <input type="file" name="video_path" class="form-control @error('video_path') is-invalid  @enderror">
                      @error('video_path')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div style="display: none;" id="vpath" class="mb-3">
                        <label for="title" class="form-label">Video Url</label>
                        <input type="text" name="link_path" placeholder="video path url" class="form-control @error('link_path') is-invalid  @enderror">
                      @error('link_path')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="form-control btn-primary">Add Video</button>
                    </div>

            </form>
        </div>
    </div>
    <script>
        
    </script>
@endsection
