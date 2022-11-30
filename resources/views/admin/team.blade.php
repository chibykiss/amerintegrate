@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">The Team</h1>
         <a class="subscribe-btn btn btn-primary" href="{{route('team.create')}}">
            <i class="bi bi-plus-circle"></i>  Create Member 
        </a>
        </div>
        @include('admin.incs.alert')
        <div class="card mb-4">
            <div class="card-body">
                @if (count($team_members) > 0)
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>member name</th>
                            <th>member Position</th>
                            <th>member Excerpt</th>
                            <th>member pic</th> 
                            <th>Publish/Unpublish</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Social links</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Member  name</th>
                            <th>Member  position</th>
                            <th>Member Excerpt</th>
                            <th>Member pic</th> 
                            <th>Publish/Unpublish</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Social links</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($team_members as $sn => $team)
                        <tr>
                            <td>{{$team->name}}</td>
                            <td>{{$team->position}}</td>
                            <td>{!! Str::limit($team->description, 40) !!}</td>
                            <td><img src="{{asset("storage/team_pic/$team->picture")}}" width="100" height="80" alt="event pic" /></td>
                            <td>
                                @if ($team->published_at === null)
                                    <a href="{{route('team.show', ['team' => $team->id])}}" class="btn btn-primary text-white" href="">publish</a>
                                @else
                                     <a href="{{route('team.show', ['team' => $team->id])}}" class="btn btn-success text-white" href="">unpublish</a>
                                @endif
                            </td>
                            <td><a href="{{route('team.edit',['team' => $team->id])}}" class="btn text-success" title="edit Event"><i class="bi bi-pencil-fill"></i></a>
                            </td>
                            <td> <form onsubmit="if(confirm('Are you sure you want to remove team member?') == true){return true}else{return false} " action="{{route('team.destroy', ['team' => $team->id])}}"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button class="btn text-danger" title="delete event"><i
                                                class="bi bi-x-lg"></i></button>
                                        </form>    
                            </td>
                            <td>
                               <a href="{{$team->facebook}}" target="_blank" class="btn text-info" title="copy to share post"><i
                                                class="bi bi-facebook"></i></a>
                                        <a href="{{$team->twitter}}" target="_blank" class="btn text-info" title="copy to share post"><i
                                                class="bi bi-twitter"></i></a>
                                        <a href="{{$team->linkedin}}" target="_blank" class="btn text-info" title="copy to share post"><i
                                                class="bi bi-linkedin"></i></a>
                            </td>
                        </tr>
                            
                        @endforeach
               
                   

                    </tbody>
                </table>
                    
                @else
                    <h4> No Team member Yet </h4>
                @endif
            </div>
        </div>
    </div>
@endsection
