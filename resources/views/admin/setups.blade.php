@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
      
        <h1 class="mt-4">Website Setups</h1>
       
      
        @include('admin.incs.alert')
        <div class="card mb-4">
            <div class="card-body">
                @if (count($setups) > 0)
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Website Address</th>
                            {{-- <th>Publish/Unpublish</th> --}}
                            <th>Change</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Website Address</th>
                            {{-- <th>Publish/Unpublish</th> --}}
                            <th>Change</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($setups as $sn => $setup)
                        <tr>
                            <td>{{$setup->website_address}}</td>
                            {{-- <td>
                                @if ($setup->published_at === null)
                                    <a href="{{route('setup.show', ['setup' => $setup->id])}}" class="btn btn-primary text-white" href="">publish</a>
                                @else
                                     <a href="{{route('setup.show', ['setup' => $setup->id])}}" class="btn btn-success text-white" href="">unpublish</a>
                                @endif
                            </td> --}}
                            <td><a href="{{route('setup.edit',['setup' => $setup->id])}}" class="btn text-success" title="edit Event"><i class="bi bi-pencil-fill"></i></a>
                            </td>
                        </tr>
                            
                        @endforeach
               
                   

                    </tbody>
                </table>
                    
                @else
                    <h4> Nothing to setup </h4>
                @endif
            </div>
        </div>
    </div>
@endsection
