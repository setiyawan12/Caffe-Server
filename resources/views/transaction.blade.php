@extends('admin.index')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Transaction Pending</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    <form method="POST" action="{{route('transaksiDetailsScan')}}" class="row gx-3 gy-2 align-items-center mb-4 mb-lg-0" enctype="multipart/form-data">
                        @csrf
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="specificSizeInputName" name="kode_unik" placeholder="">
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{route('transaction.index')}}" method="GET">
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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-nowrap align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th style="width: 140px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $data)
                                <tr class="text-center">
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{"Rp.".number_format($data->total_harga)}}</td>
                                    <td>{{ $data->pesanan }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>
                                        <a href="{{route('transaksiConfirm', Crypt::encrypt($data->id))}}">
                                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                                <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>
                                                confim
                                            </button>
                                        </a>
                                        <a href="{{route('transaksiCancle', Crypt::encryptString($data->id))}}">
                                            <button type="button" class="btn btn-danger waves-effect waves-light">
                                                <i class="bx bx-block font-size-16 align-middle me-2"></i> Cancel
                                            </button>
                                        </a>
                                        <a href="{{route ('transaksiDetails', Crypt::encryptString($data->id))}}">
                                            <button type="button" class="btn btn-warning waves-effect waves-light">
                                                <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i>
                                                Detail
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Transaction Progres</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Progress Transaction</h4>
                    <form action="{{route('transaction.index')}}" method="GET">
                        <div class="d-flex" style="align-items: flex-end">
                            <div class="mb-3">
                                <label class="form-label">Date from</label>
                                <input name="start_date1" type="text" class="form-control" id="datepicker-basic2">
                            </div>
                            <div class="mb-3" style="margin-left: 10px">
                                <label class="form-label">Date to</label>
                                <input name="end_date1" type="text" class="form-control" id="datepicker-basic2">
                            </div>
                            <div class="mb-3" style="margin-left: 10px">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                   </form>
                </div>
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Total</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th style="width: 140px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksiSelesai as $data)
                            <tr class="text-center">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{"Rp.".number_format($data->total_harga)}}</td>
                                <td>{{ $data->pesanan }}</td>
                                <td>
                                    @if($data->status == "DIKIRIM")
                                    <span class="text-primary text-uppercase">DIKIRIM</span>
                                    @elseif($data->status == "PROSES")
                                    <span class="text-warning text-uppercase">Proses</span>
                                    @elseif($data->status == "SELESAI")
                                    <span class="text-success text-uppercase">Selesai</span>
                                    @elseif($data->status == "BATAL")
                                    <span class="text-danger text-uppercase">Canceled</span>
                                    @endif
                                </td>
                                <td>
                                    @if($data->status == "DIKIRIM")
                                    <a href="{{route ('transaksiDetail', Crypt::encryptString($data->id))}}">
                                    <button type="button" class="btn btn-primary waves-effect waves-light">
                                                <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>
                                                Checkout
                                            </button>
                                    </a>
                                    @elseif($data->status == "PROSES")
                                    <a href="{{ route('transaksiKirim', Crypt::encryptString($data->id)) }}">
                                    <button type="button" class="btn btn-warning waves-effect waves-light">
                                                <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i>
                                                Kirim
                                            </button>
                                    </a>
                                    @elseif($data->status == "SELESAI" || $data->status == "BATAL")
                                    <a href="{{route ('transaksiDetailSelesai', Crypt::encryptString($data->id))}}">
                                        <button type="button" class="btn btn-success waves-effect waves-light">
                                            <i class="bx bx-check-double font-size-16 align-middle me-2"></i> Detail
                                        </button>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end cardaa -->
        </div> <!-- end col -->
    </div>

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

@endsection