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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Editable Tables</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Transaction</h4>
                   <form action="{{route('filter.index')}}" method="GET">
                        <div class="d-flex" style="align-items: flex-end">
                            <div class="mb-3">
                                <label class="form-label">Date from</label>
                                <input name="start_date" type="text" class="form-control" id="datepicker-basic">
                            </div>
                            <div class="mb-3" style="margin-left: 10px">
                                <label class="form-label">Date to</label>
                                <input name="end_date" type="text" class="form-control" id="datepicker-basic">
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
    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });

    </script>

    @section('script')
    <script>
        flatpickr("#datepicker-basic", {
            defaultDate: new Date
        })
    </script>
    @endsection
