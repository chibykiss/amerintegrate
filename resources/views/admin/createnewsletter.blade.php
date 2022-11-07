@extends('admin.layouts.app')
@section('content')
<div class="container-fluid px-4" >
    <div class="d-flex justify-content-between align-items-center mt-5 mx-4">
        <h3 class="mb-0 text-uppercase">All Subscribers</h3>
        <a href="{{route('mail.create')}}"><button title="send message to all subscribers" class="subscribe-btn btn btn-primary">send
                bulk message</button></a>
    </div>
    <hr />
    <div class="card">
        <div class="card-body">
            @if (count($subscribers) > 0)
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table.bordered table-stripped" style="width: 100%">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Email</th>
                            <th>Send message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $sn => $subscriber)
                        <tr>
                            <td>{{$sn+1}}</td>
                            <td>{{$subscriber->email}}</td>
                            <td><a href="{{route('email.create', ['mail' => $subscriber->email])}}" class="btn">send message</a></td>
                        </tr>
                             
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <h4 style="text-align: center;"> No Subscriber Found </h4>
            @endif
        </div>
            
    </div>
</div>
@endsection
