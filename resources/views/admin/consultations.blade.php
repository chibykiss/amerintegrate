@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h3 class="mb-0 text-uppercase">Consulatations</h3>
        <hr />
        @include('admin.incs.alert')
        <div class="card">
            <div class="card-body">
                @if (count($consultations) > 0)
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table.bordered table-stripped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Phone number</th>
                                    <th>country/State</th>
                                    <th>service_type</th>
                                    <th>Approve</th>
                                    <th>Send message</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultations as $sn => $consultation)
                                    <tr>
                                        <td>{{ $sn + 1 }}</td>
                                        <td>{{ $consultation->fullname }}</td>
                                        <td>{{ $consultation->email }}</td>
                                        <td>{{ $consultation->consult_date }}</td>
                                        <td>{{ $consultation->phone_number }}</td>
                                        <td>{{ $consultation->country }}/{{ $consultation->state }}</td>
                                        <td>{{ $consultation->service_type }}</td>
                                        @if ($consultation->approved == 0)
                                            <td><a href="{{ route('consultation.approve', ['id' => $consultation->id]) }}"
                                                    class="btn btn-primary">Approve</a></td>
                                        @else
                                            <td><button href="#" class="btn btn-primary" disabled>Approved</button>
                                            </td>
                                        @endif
                                        <td><a href="{{route('consultation.email', ['email' => $consultation->email])}}" class="btn btn-info">send</a></td>
                                        <td>
                                            <form
                                                onsubmit="if(confirm('Are you sure you want to delete post?') == true){return true}else{return false} "
                                                action="{{}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn text-danger" title="delete event"><i
                                                        class="bi bi-x-lg"></i></button>
                                            </form>
                                        </td>
                                        {{-- <td>{{$subscriber->email}}</td> --}}
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
f
