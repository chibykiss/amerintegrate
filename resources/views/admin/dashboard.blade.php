    @extends('admin.layouts.app')
    @section('content')
        
            <div class="container-fluid px-4">
                <h1 class="mt-4">Welcome</h1>
                <ol class="breadcrumb mb-4">
                    {{-- <li class="breadcrumb-item active">Admin 1</li> --}}
                </ol>
                <div class="dash-parent-container">
                    <div class="dash-container">
                        <div class="card dash-container-inner">
                            <div class="card-body dash-container-body">
                                <i class="bi bi-file-post text-primary h2"></i>
                                <h4 class="text-primary">Published Posts</h4>
                                <h5>{{$posts}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="dash-container">
                        <div class="card dash-container-inner">
                            <div class="card-body dash-container-body">
                                <i class="bi bi-view-list text-primary h2"></i>
                                <h4 class="text-primary">Published Events</h4>
                                <h5>{{$events}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="dash-container">
                        <div class="card dash-container-inner">
                            <div class="card-body dash-container-body">
                                <i class="bi bi-question-circle text-primary h2"></i>
                                <h4 class="text-primary">New consulatation</h4>
                                <h5>{{$consultations}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="dash-container">
                        <div class="card dash-container-inner">
                            <div class="card-body dash-container-body">
                                <i class="bi bi-currency-dollar text-primary h2"></i>
                                <h4 class="text-primary">Total Donation</h4>
                                <h5>{{$total_dollar}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="dash-container">
                        <div class="card dash-container-inner">
                            <div class="card-body dash-container-body">
                                <i class="text-primary h2">₦</i>
                                <h4 class="text-primary">Total Donation</h4>
                                <h5>{{$total_naira}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        <!-- end row -->
    @endsection
