@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">All Newsletters</h1>
        @include('admin.incs.alert')
        <div class="card mb-4">
            <div class="card-body">
                @if (count($newsletters) > 0)
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Subject</th>
                            <th>Who Sent</th> 
                            <th>Sent To</th> 
                            <th>Body Excerpt</th> 
                            <th>Message Status</th> 
                            <th>date Sent</th>
                            <th>Resend</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Subject</th>
                            <th>Who Sent</th> 
                            <th>Sent To</th> 
                            <th>Body Excerpt</th> 
                            <th>Message Status</th> 
                            <th>date Sent</th>
                            <th>Resend</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($newsletters as $sn => $newsletter)
                        <tr>
                            <td>{{$sn+1}}</td>
                            <td>{{$newsletter->subject}}</td>
                            <td>{{$newsletter->admin->name}}</td>
                            <td>{{$newsletter->via}}</td>
                            <td>{!! Str::limit($newsletter->body, 40) !!}</td>
                            <td>{{$newsletter->send_status}}</td>
                            <td>{{$newsletter->created_at}}</td>
                            <td><a href="{{route('mail.edit',['mail' => $newsletter->id])}}" class="btn text-success" title="edit Event"><i class="bi bi-pencil-fill"></i></a>
                            </td>
                            <td> <form onsubmit="if(confirm('Are you sure you want to delete post?') == true){return true}else{return false} " action="{{route('mail.destroy', ['mail' => $newsletter->id])}}"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button class="btn text-danger" title="delete event"><i
                                                class="bi bi-x-lg"></i></button>
                                        </form>    
                            </td>
                            {{-- <td>
                               <button class="btn text-info" title="copy to share post"><i
                                                class="bi bi-facebook"></i></button>
                                        <button class="btn text-info" title="copy to share post"><i
                                                class="bi bi-twitter"></i></button>
                                        <button class="btn text-info" title="copy to share post"><i
                                                class="bi bi-instagram"></i></button>
                            </td> --}}
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
