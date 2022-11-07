@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">All Videos</h1>
        @include('admin.incs.alert')
        <div class="card mb-4">
            @if (count($videos) > 0)
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>video Title</th>
                                <th>video description</th>
                                <th>the Video </th>
                                <th>Delete</th>
                                <th>Share Link</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>video Title</th>
                                <th>video description</th>
                                <th>the Video </th>
                                <th>Delete</th>
                                <th>Share Link</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($videos as $sn => $video)
                                <tr>
                                    <td>{{ $sn + 1 }}</td>
                                    <td>{{ $video->title }}</td>
                                    <td>{{ $video->detail }}</td>
                                    <td>
                                        @if ($video->via === 'manual')
                                             <video class="thumbnail" width="320" height="240" controls>
                                            <source src="{{asset("storage/videos/$video->video_path")}}" type="video/mp4">
                                            <source src="movie.ogg" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>
                                        @else
                                        <iframe class="thumbnail" width="320" height="240`" src="{{$video->link_path}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        @endif
                                       
                                    </td>
                                    <td><form onsubmit="if(confirm('Are you sure you want to delete video?') == true){return true}else{return false} " action="{{"video/$video->id"}}"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button class="btn text-danger" title="delete event"><i
                                                class="bi bi-x-lg"></i></button>
                                        </form>    
                                    </td>
                                    <td>
                                        <button class="btn text-info" title="copy to share post"><i
                                                class="bi bi-collection-fill"></i></button>
                                    </td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            @else
                <h4> No Videos yet </h4>
            @endif
        </div>
    </div>
@endsection
