@extends('admin.index')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Pesanan</h4>

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
        @foreach($orderPending as $data)
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-50 shadow-lg p-3 mb-5  rounded">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate text-center">
                                <h2>{{$data->name}}</h2>
                            </span>
                            <h4 class="mb-3">
                                <span
                                    class="text-muted mb-3 lh-1 d-block text-truncate text-center">{{$data -> pesanan}}</span>
                            </h4>
                            <h4 class="mb-3">
                                <span
                                    class="text-muted mb-3 lh-1 d-block text-truncate text-center">{{$data -> meja}}</span>
                            </h4>
                        </div>
                    </div>
                    <div class="text-nowrap text-center">
                        <a href="{{url ('pesanan/'.$data->id)}}">
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i
                                    class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i>Detail</button>
                        </a>
                        <a href="{{route('pesananKirim', $data->id)}}">
                            <button type="button" class="btn btn-outline-success waves-effect waves-light"><i
                                    class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>Delivered</button>
                        </a>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        @endforeach
    </div>
</div>
@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
