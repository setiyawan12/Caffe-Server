@extends('admin.index')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Order</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                            <div class="d-flex align-items-start mt-3 mt-sm-0">
                                <div class="flex-shrink-0">
                                    <div class="avatar-xl me-3">
                                        <img src="{{ asset ('core/images/avatar.png')}}" alt=""
                                            class="img-fluid rounded-circle d-block">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-16 mb-1">{{$name}}</h5>
                                        <p class="text-muted font-size-13">Customer # {{$dt->id}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-auto order-1 order-sm-2">
                            <div class="d-flex align-items-start justify-content-end gap-2">
                                <div>
                                    <button type="button" class="btn btn-soft-light"><i class="me-1"></i>
                                        Message</button>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link font-size-16 shadow-none text-muted dropdown-toggle"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" data-bs-toggle="tab" href="#about" role="tab">Details</a>
                        </li>
                    </ul>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="tab-content">
                <div class="tab-pane active" id="overview" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Order</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">

                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Name</th>
                                            <th>Total Item</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        @foreach($dt->details as $data)
                                        <tr>
                                            <td>{{ $dt->kode_unik}}</td>
                                            <td>{{ $data->produk->name }}</td>
                                            <td>{{ $data->total_item }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end tab pane -->

                <div class="tab-pane" id="about" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="mb-4">
                                            <h2>{{$dt -> name}}</h2>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="mb-4">
                                            <h4 class="float-end font-size-16">Customer # {{$dt->id}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <h5 class="font-size-15 mb-3">History:</h5>
                                        <h5 class="font-size-14 mb-2">Transaction Status</h5>
                                        <p class="mb-1 text-uppercase">{{$midtrans -> transaction_status}}</p>
                                        <h5 class="font-size-14 mb-2 mt-3">Merchant Id</h5>
                                        @foreach($va_numbers as $number)
                                        <p class="mb-1">{{$number}}</p>
                                        @endforeach
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <div>
                                            <h5 class="font-size-15">Order Date:</h5>
                                            <p>{{$midtrans -> transaction_time}}</p>
                                        </div>

                                        <div class="mt-3">
                                            <h5 class="font-size-15">Payment Method:</h5>
                                            <p class="mb-1">{{$midtrans -> payment_type}}</p>
                                        </div>
                                        <div class="mt-3">
                                            <h5 class="font-size-15">Currency:</h5>
                                            <p class="mb-1">{{$midtrans -> currency}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="py-2 mt-3">
                                <h5 class="font-size-15">Order summary</h5>
                            </div>
                            <div class="p-4 border rounded">
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No.</th>
                                                <th>Item</th>
                                                <th>Harga</th>
                                                <th>Total Item</th>
                                                <th class="text-end" style="width: 120px;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dt->details as $data)
                                            <tr>
                                                <td scope="row">{{ $dt->kode_unik}}</td>
                                                <td>
                                                    <h5 class="font-size-15 mb-1">{{ $data->produk->name }}</h5>
                                                </td>
                                                <td scope="row">{{"Rp.".number_format($data->produk->harga) }}</td>
                                                <td scope="row">{{ $dt->total_item}}</td>
                                                <td class="text-end">
                                                    {{"Rp.".number_format($data->produk->harga * $data->total_item )}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                                <td class="text-end">{{"Rp.".number_format($dt->total_harga)}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">
                                                    Tax</th>
                                                <td class="border-0 text-end">$0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                <td class="border-0 text-end">
                                                    <h4 class="m-0">{{"Rp.".number_format($dt->total_harga)}}</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-print-none mt-3">
                                <div class="float-end">
                                    <a href="javascript:window.print()"
                                        class="btn btn-success waves-effect waves-light me-1"><i
                                            class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end tab pane -->

                <!-- end tab pane -->
            </div>
            <!-- end tab content -->
        </div>
        <!-- end col -->
        <!-- end col -->
    </div>
    <!-- end row -->

</div>
@endsection
