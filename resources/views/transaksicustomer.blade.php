@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Table User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Striped Full Width Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th style="width: 40px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listUser as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->total_harga }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                        <a href="{{url ('customer/'.$data->id)}}">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
