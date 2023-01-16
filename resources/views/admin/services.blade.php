@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">All Services</h1>
         <a class="subscribe-btn btn btn-primary" href="{{route('service.create')}}">
            <i class="bi bi-plus-circle"></i>  create service
        </a>
        </div>
        @include('admin.incs.alert')
        <div class="card mb-4">
            <div class="card-body">
                @if (count($services) > 0)
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Service Title</th>
                            <th>Details Excerpt</th>
                            <th>Service pic</th> 
                            <th>Publish/Unpublish</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Service Title</th>
                            <th>Details Excerpt</th>
                            <th>Service pic</th> 
                            <th>Publish/Unpublish</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($services as $sn => $service)
                        <tr>
                            <td>{{$service->name}}</td>
                            <td>{!! Str::limit($service->content, 40) !!}</td>
                            <td><img src="{{asset("storage/service_pic/$service->picture")}}" width="150" height="50" alt="service pic" /></td>
                            <td>
                                @if ($service->published_at === null)
                                    <a href="{{route('service.show', ['service' => $service->id])}}" class="btn btn-primary text-white" href="">publish</a>
                                @else
                                     <a href="{{route('service.show', ['service' => $service->id])}}" class="btn btn-success text-white" href="">unpublish</a>
                                @endif
                            </td>
                            <td><a href="{{route('service.edit',['service' => $service->id])}}" class="btn text-success" title="edit Event"><i class="bi bi-pencil-fill"></i></a>
                            </td>
                            <td> <form onsubmit="if(confirm('Are you sure you want to delete service?') == true){return true}else{return false} " action="{{route('service.destroy', ['service' => $service->id])}}"  method="POST">
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
                    <h4> No Services Yet </h4>
                @endif
            </div>
        </div>
    </div>
@endsection
