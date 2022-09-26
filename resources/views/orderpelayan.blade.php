@extends('pelayan.index')
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
    <!-- <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="cardtitle">Order Transaction</h4>
                    <form action="" method="GET">
                        <div class="d-flex" style="align-items: flex-end">
                            <div class="mb-3">
                                <label class="form-label">Date from</label>
                                <input name="start_date" type="text" class="form-control" id="datepicker-basic1">
                            </div>
                            <div class="mb-3" style="margin-left: 10px">
                                <label class="form-label">Date to</label>
                                <input name="end_date" type="text" class="form-control" id="datepicker-basic1">
                            </div>
                            <div class="mb-3" style="margin-left: 10px">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                   </form>
                </div> -->
    <div class="row">
        @foreach($orderPending as $data)
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-50 shadow-lg p-3 mb-5  rounded">
                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate text-center">
                                    <h2>{{$data->name}}</h2>
                                </span>
                                <h5 class="mb-3">
                                <span
                                    class="text-muted mb-3 lh-1 d-block text-truncate text-center">{{$data -> created_at}}</span>
                            </h5>
                            <h6 class="mb-3">
                                <span
                                    class="text-muted mb-3 lh-1 d-block text-truncate text-center">{{$data -> pesanan}}</span>
                            </h6>
                            <h6 class="mb-3">
                                <span
                                    class="text-muted mb-3 lh-1 d-block text-truncate text-center">Table {{$data -> meja}}</span>
                            </h6>
                        </div>
                    </div>
                    <div class=" text-center">
                        <a href="{{url ('pesanancustomer/'.$data->id)}}">
                            <button type="button" class="btn btn-outline-warning waves-effect waves-light"><i
                                    class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i>Detail</button>
                        </a>
                        @if($data->status == "MENUNGGU")
                        <a href="{{route('pesanancustomerConfirm', $data->id)}}">
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i
                                    class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>Confirm</button>
                        </a>
                        @elseif($data->status == "PROSES")
                        <a href="{{route('pesanancustomerkirim', $data->id)}}">
                            <button type="button" class="btn btn-outline-success waves-effect waves-light"><i
                                    class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>Deliver</button>
                        </a>
                        @endif
                        <!-- <a href="" id ="cancle_id" data-id="{{$data->id}}"> -->
                            @if($data->status == "MENUNGGU")
                                <button type="button" onclick="updateRow({{$data->id}})" class="btn btn-outline-danger waves-effect waves-light"><i class="bx bx-block font-size-16 align-middle me-2"></i>Cancle</button>
                                @endif
                            <!-- </a> -->
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        @endforeach
    </div>
</div>
@endsection
<script>
    function updateRow(id){
        // alert(id);
        swal({
                title: "Are you sure?",
                text: "are you sure you cancel the order",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    // alert(id)
                 $.ajax({
                    type:"GET",
                    url:"/pesanancustomer/cancle/"+id,
                    success:function(response){
                        location.reload(); 
                    }
                 })
                }
            })
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('core/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
        </script>
        <script>

        flatpickr("#datepicker-basic1", {
            defaultDate: new Date
        })
        flatpickr("#datepicker-basic2", {
            defaultDate: new Date
        })
        </script>