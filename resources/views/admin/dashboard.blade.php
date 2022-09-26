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
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Income This Year</h4>
                </div>
                <div class="card-body">

                    <div id="line_chart_datalabel" data-colors='["#5156be", "#2ab57d"]' class="apex-charts" dir="ltr">
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
    </div>
    <!-- <div class="row">
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
                    <h4 class="card-title">Transaction History</h4>
                   <form action="{{route('admin.index')}}" method="GET">
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

    </div>
</div>
@endsection

@section('script')
<script>
    let chartDataTransaction = {!! json_encode($dataChartTransaction) !!};
    console.log(JSON.stringify(Object.values(chartDataTransaction)))
    var lineDatalabelColors = getChartColorsArray("#line_chart_datalabel"),
    options = {
        chart: {
            height: 300,
            type: "bar",
            zoom: {
                enabled: !1
            },
            toolbar: {
                show: !1
            }
        },
        colors: lineDatalabelColors,
        dataLabels: {
            enabled: !1
        },
        stroke: {
            width: [3, 3],
            curve: "straight"
        },
        series: [{
            name: "Transaction",
            data: Object.values(chartDataTransaction)
        }],
        grid: {
            row: {
                colors: ["transparent", "transparent"],
                opacity: .2
            },
            borderColor: "#f1f1f1"
        },
        markers: {
            style: "inverted",
            size: 0
        },
        xaxis: {
            categories: Object.keys(chartDataTransaction),
            title: {
                text: "Month"
            }
        },
        yaxis: {
            title: {
                text: "Total"
            },
            min: 5,
        },
        legend: {
            position: "top",
            horizontalAlign: "right",
            floating: !0,
            offsetY: -10,
            offsetX: -5
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    toolbar: {
                        show: !1
                    }
                },
                legend: {
                    show: !1
                }
            }
        }]
    },
    chart = new ApexCharts(document.querySelector("#line_chart_datalabel"), options);

    chart.render();
    flatpickr("#datepicker-basic", {
            defaultDate: new Date
        })
    
</script>

@endsection