@extends('admin.layouts.app')
@section('content')
    <div class="card w-50 mx-auto mt-5">
        <div class="card-body">
            <h5 class="text-primary">Edit Admin Admin</h5>
            <hr />
            <form action="{{route('admin.update', ['admin' => $admin->id])}}" method="post">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="form-label">Admin Name</label>
                    <input type="text" name="name" value="{{$admin->name}}" class="form-control @error('name') is-invalid  @enderror" id="name">
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="{{$admin->email}}" class="form-control @error('email') is-invalid  @enderror" id="email">
                     @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                 <div class="mb-3">
                    <label for="email" class="form-label">Password</label>
                    <input type="password" value="{{$admin->password}}" name="password" class="form-control @error('password') is-invalid  @enderror" id="email">
                     @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                   <div class="mb-3">
                    <label for="email" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="email">
                    
                </div>
                <div class="mb-3">
                    <button type="submit" class="form-control btn-primary">Update Admin</button>
                </div>

            </form>
        </div>
    </div>
@endsection
