@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">All Donations</h1>
        @include('admin.incs.alert')
        <div class="card mb-4">
            <div class="card-body">
                @if (count($donations) > 0)
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th> 
                            <th>Amount(currency)</th> 
                            <th>Gateway</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>trnxid</th>
                            <th>Name</th>
                            <th>Email</th> 
                          	<th>Amount(currency)</th> 
                            <th>Gateway</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($donations as $sn => $donate)
                        <tr>
                            <td>{{$donate->signature}}</td>
                            <td>{{$donate->name}}</td>
                            <td>{{$donate->email}}</td>
                            <td>{{$donate->currency.' '.$donate->amount}}</td>
                            <td>{{$donate->gateway}}</td>
                            <td>{{$donate->status}}</td>
                            <td>
                                {{$donate->created_at->diffForHumans()}}
                            </td>
                        </tr>
                            
                        @endforeach
               
                   

                    </tbody>
                </table>
                    
                @else
                    <h4> No Donations Yet </h4>
                @endif
            </div>
        </div>
    </div>
@endsection
