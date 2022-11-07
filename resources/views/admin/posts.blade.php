@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">All Posts</h1>
        @include('admin.incs.alert')
        <div class="card mb-4">
            @if (count($posts) > 1)
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Post Title</th>
                                <th>Excerpt</th>
                                <th>Date Posted</th>
                                <th>Publish/Unpublish</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Share Link</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Post Title</th>
                                <th>Excerpt</th>
                                <th>Date Posted</th>
                                <th>Publish/Unpublish</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Share Link</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($posts as $index => $post)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{!! Str::limit($post->postbody, 50) !!}</td>
                                    <td>{{ $post->created_at->diffForHumans() }}</td>
                                    <th>
                                        @if ($post->published_at === null)
                                            <a href="{{route('post.show', ['post' => $post->id])}}" class="btn btn-primary text-white" href="">publish</a>
                                        @else
                                            <a href="{{route('post.show', ['post' => $post->id])}}" class="btn btn-success text-white" href="">unpublish</a>
                                        @endif
                                    </th>
                                    <td><a href="{{ route('post.edit', ['post' => $post->id]) }}" class="btn text-success"
                                            title="edit post"><i class="bi bi-pencil-fill"></i></a></td>

                                    <td>
                                        <form
                                            onsubmit="if(confirm('Are you sure you want to delete post?') == true){return true}else{return false} "
                                            action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn text-danger" title="delete post"><i
                                                    class="bi bi-x-lg"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn text-info" title="copy to share post"><i
                                                class="bi bi-facebook"></i></button>
                                        <button class="btn text-info" title="copy to share post"><i
                                                class="bi bi-twitter"></i></button>
                                        <button class="btn text-info" title="copy to share post"><i
                                                class="bi bi-instagram"></i></button>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            @else
                <h4>Theres no post yet </h4>
            @endif
        </div>
    </div>
    <script>
        function confirmDel(e) {
            e.preventDefault();
            alert('here');
        }
    </script>
@endsection
