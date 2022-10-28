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
                                <h4 class="text-primary">No of Posts</h4>
                                <h5>100</h5>
                            </div>
                        </div>
                    </div>
                    <div class="dash-container">
                        <div class="card dash-container-inner">
                            <div class="card-body dash-container-body">
                                <i class="bi bi-view-list text-primary h2"></i>
                                <h4 class="text-primary">Page Views</h4>
                                <h5>200</h5>
                            </div>
                        </div>
                    </div>
                    <div class="dash-container">
                        <div class="card dash-container-inner">
                            <div class="card-body dash-container-body">
                                <i class="bi bi-question-circle text-primary h2"></i>
                                <h4 class="text-primary">Support Request</h4>
                                <h5>10</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        <!-- end row -->
    @endsection
