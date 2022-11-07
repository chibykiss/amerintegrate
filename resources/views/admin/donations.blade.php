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
                            <th>GAteway</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th> 
                            <th>Amount</th> 
                            <th>GAteway</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($donations as $sn => $donate)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                              <form onsubmit="if(confirm('Are you sure you want to delete post?') == true){return true}else{return false} " action="{{route('event.destroy', ['event' => $event->id])}}"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button class="btn text-danger" title="delete event"><i
                                                class="bi bi-x-lg"></i></button>
                                        </form>   
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
