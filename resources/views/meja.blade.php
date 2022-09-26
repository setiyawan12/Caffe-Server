@extends('admin.index')
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Table</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <form method="POST" action="{{route('table.store')}}"
                            class="row gx-3 gy-2 align-items-center mb-4 mb-lg-0" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="specificSizeInputName" name="no_meja"
                                    placeholder="Add Table">
                                @error('no_meja')
                                {{$message}}
                                @enderror
                            </div>
                            <div class="col-sm-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        @foreach($data as $data)
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-50 shadow-lg p-3 mb-5  rounded">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-1 lh-1 d-block text-truncate text-center">
                                <h2>Table</h2>
                            </span>
                            <h4 class="mb-1">
                                <span
                                    class="text-muted mb-1 lh-1 d-block text-truncate text-center">{{$data->no_meja}}</span>
                            </h4>
                            <h4 class="mb-1">
                                @if($data->status == "Aktif")
                                <a href="{{route('updateTableNonAktif',$data->id)}}">
                                    <div class="">
                                        <span
                                            class=" mb-1 lh-1 d-block text-truncate text-center text-success">Active</span>
                                    </div>
                                </a>
                                @elseif($data->status == "Tidak Aktif")
                                <a href="{{route('updateTable',$data->id)}}">
                                    <span
                                        class="text-danger mb-1 lh-1 d-block text-truncate text-center">Not Active</span>
                                </a>
                                @endif
                            </h4>
                        </div>
                    </div>
                    <div class="text-nowrap text-center mt-2">

                        <button class="btn btn-outline-primary waves-effect waves-light" onclick="show({{$data->id}})">
                            Show QR
                        </button>
                        @if($data->status == "Aktif")
                        <a href="{{route('updateTableNonAktif',$data->id)}}" class="btn btn-outline-danger waves-effect waves-light">
                            <span>Change</span>
                        </a>
                        @elseif($data->status == "Tidak Aktif")
                        <a href="{{route('updateTable',$data->id)}}" class="btn btn-outline-success waves-effect waves-light">
                            <span>Change</span>
                        </a>
                        @endif
                        <!-- <button class="btn btn-outline-primary waves-effect waves-light" onclick="show({{$data->id}})">
                            Show QR
                        </button> -->
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        @endforeach
    </div>
</div>
<div class="modal fade" id="ModalQr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelQr">QR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center m-4">
                    <img id="ImageQr" src="" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function show(id) {
        $('#ModalQr').modal('show');
        $.ajax({
            type: "GET",
            url: "/table/" + id + "/edit",
            success: function (response) {
                console.log(response.data.status);
                $('#ImageQr').attr('src', response.data.qr);
            }
        })
    }

</script>
@endsection
