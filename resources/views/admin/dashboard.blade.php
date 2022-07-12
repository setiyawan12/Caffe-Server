@extends('admin.index')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-3">
            <div class="card border border-primary text-center">
                <div class="card-header bg-transparent border-primary">
                    <h2 class="my-0 text-primary">Proudct</h2>
                </div>
                <div class="card-body">
                    <h1 class="text-primary">{{$produk}}</h1>
                    <a href="javascript: void(0);" class="btn btn-outline-primary w-100">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card border border-success text-center">
                <div class="card-header bg-transparent border-success">
                    <h2 class="my-0 text-success">Customer</h2>
                </div>
                <div class="card-body">
                    <h1 class="text-success">{{$customer}}</h1>
                    <a href="javascript: void(0);" class="btn btn-outline-success w-100">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card border border-info text-center">
                <div class="card-header bg-transparent border-info">
                    <h2 class="my-0 text-info">Transaction</h2>
                </div>
                <div class="card-body">
                    <h1 class="text-info">{{$transaction}}</h1>
                    <a href="javascript: void(0);" class="btn btn-outline-info w-100">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
        <div class="card border border-warning text-center">
                <div class="card-header bg-transparent border-warning">
                    <h2 class="my-0 text-warning">Gateway</h2>
                </div>
                <div class="card-body">
                    <h1 class="text-warning">{{$produk}}</h1>
                    <a href="javascript: void(0);" class="btn btn-outline-warning w-100">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="font-size-16">Food</h5>
                        <div class="progress progress-lg">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{$food}}%">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-size-16">Drink</h5>
                        <div class="progress progress-lg">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{$drink}}%">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-size-16">Snack</h5>
                        <div class="progress progress-lg">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{$snack}}%">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-size-16">Coffe</h5>
                        <div class="progress progress-lg">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{$coffe}}%">
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>
</div>
@endsection
