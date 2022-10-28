@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">All Events</h1>
        @include('admin.incs.alert')
        <div class="card mb-4">
            <div class="card-body">
                @if (count($events) > 0)
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Event Title</th>
                            <th>Details Excerpt</th>
                            <th>Event Date</th> 
                            <th>Event pic</th> 
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Share Link</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Event Title</th>
                            <th>Details Excerpt</th>
                            <th>Event Date</th> 
                            <th>Event pic</th> 
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Share Link</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($events as $sn => $event)
                        <tr>
                            <td>{{$event->title}}</td>
                            <td>{!! Str::limit($event->event_detail, 40) !!}</td>
                            <td>{{$event->event_date}}</td>
                            <td><img src="{{asset("storage/images/event_pic/$event->event_pic")}}" width="150" height="50" alt="event pic" /></td>
                            <td><a href="{{route('event.edit',['event' => $event->id])}}" class="btn text-success" title="edit Event"><i class="bi bi-pencil-fill"></i></a>
                            </td>
                            <td> <form onsubmit="if(confirm('Are you sure you want to delete post?') == true){return true}else{return false} " action="{{route('event.destroy', ['event' => $event->id])}}"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button class="btn text-danger" title="delete event"><i
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
                    
                @else
                    <h4> No Events Yet </h4>
                @endif
            </div>
        </div>
    </div>
@endsection
