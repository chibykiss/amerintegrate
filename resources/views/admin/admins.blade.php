@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        @include('admin.incs.alert')
        <h1 class="mt-4">All Admin</h1>
        <div class="card mb-4">
            <div class="card-body">
                @if (count($admins) > 0)
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Admin Name</th>
                                    <th>Admin Email</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $sn => $admin)
                                    <tr>
                                        <td>{{ $sn + 1 }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td><a href="{{ route('admin.edit', ['admin' => $admin->id]) }}"
                                                class="btn text-success" title="edit post"><i
                                                    class="bi bi-pencil-fill"></i></a></td>
                                        <td>
                                            <form
                                                onsubmit="if(confirm('Are you sure you want to delete post?') == true){return true}else{return false} "
                                                action="{{ route('admin.destroy', ['admin' => $admin->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn text-danger" title="delete post"><i
                                                        class="bi bi-x-lg"></i></button>
                                            </form>

                                        </td>
                                        <td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h4>You are the Only Admin </h4>
                @endif
            </div>
        </div>
    </div>
@endsection
