@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
      	<div class="d-flex justify-content-between align-items-center mx-4">
        <h1 class="mt-4">All Faqs</h1>
       <a href="{{route('faq.create')}}"><button title="create website frequently asked questions" class="subscribe-btn btn btn-primary">Add
                Faq</button></a>
      </div>
        @include('admin.incs.alert')
        <div class="card mb-4">
            <div class="card-body">
                @if (count($faqs) > 0)
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Question</th>
                            <th>Answer</th> 
                            <th>Created</th> 
                            <th>Publish/Unpublish</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Question</th>
                            <th>Answer</th> 
                            <th>Created</th> 
                            <th>Publish/Unpublish</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($faqs as $sn => $faq)
                        <tr>
                            
                            <td>{{$sn+1}}</td>
                            <td>{{$faq->question}}</td>
                            <td>{!! $faq->answer !!}</td>
                            <td>{{$faq->created_at}}</td>
                            <td>
                                @if ($faq->published_at === null)
                                    <a href="{{route('faq.show', ['faq' => $faq->id])}}" class="btn btn-primary text-white" href="">publish</a>
                                @else
                                     <a href="{{route('faq.show', ['faq' => $faq->id])}}" class="btn btn-success text-white" href="">unpublish</a>
                                @endif
                            </td>
                            <td><a href="{{route('faq.edit',['faq' => $faq->id])}}" class="btn text-success" title="edit Event"><i class="bi bi-pencil-fill"></i></a>
                            </td>
                            <td> <form onsubmit="if(confirm('Are you sure you want to delete faq?') == true){return true}else{return false} " action="{{route('faq.destroy', ['faq' => $faq->id])}}"  method="POST">
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
                    <h4> No faqs Yet </h4>
                @endif
            </div>
        </div>
    </div>
@endsection
