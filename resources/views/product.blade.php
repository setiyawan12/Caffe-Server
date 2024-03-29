@extends('admin.index')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    @error('stock')
    {{$message}}
    @enderror
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Product</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Add Product</button>
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
                    <h4 class="card-title">Table Product</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Update At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produk as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{"Rp.".number_format($data->harga)}}</td>
                                    <td>
                                        @if($data->category_id == 1)
                                        <span>Food</span>
                                        @elseif($data->category_id == 2)
                                        <span>Drink</span>
                                        @elseif($data->category_id == 3)
                                        <span>Snack</span>
                                        @elseif($data->category_id == 4)
                                        <span>Coffe</span>
                                        @endif
                                    </td>
                                    <td>{{$data->stock}}</td>
                                    <td>{{ $data->updated_at}}</td>
                                    <td class="text-center">
                                        <form action="{{ route('product.destroy', $data->id) }}" method="post"
                                            class="sa-remove" id="data-{{ $data->id }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                        <button onclick="deleteRow({{ $data->id }})"
                                            class="btn btn-danger waves-effect waves-lightr"><i
                                                class="bx bx-block font-size-16 align-middle me-2"></i>Delete</button>
                                        <button onclick="edit({{ $data->id }})"
                                            class="btn btn-warning waves-effect waves-light">
                                            <i
                                                class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i>Update</button>
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
    <!-- end row -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </button>
                </div>
                <form method="POST" action="{{ route('product.store') }}" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Nama" name="name" required>
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" class="form-control" placeholder="Harga ..." name="harga"
                                        min="1" max="100000" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Pilih Category</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="1">Food</option>
                                        <option value="2">Drink</option>
                                        <option value="3">Snack</option>
                                        <option value="4">Coffe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" class="form-control" placeholder="Stock ..." name="stock"
                                        min="1" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" rows="3"
                                placeholder="Deskripsi ..." name="deskripsi" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        accept="image/png, image/gif, image/jpeg" id="exampleInputFile" name="image"
                                        required>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </button>
                </div>
                <form method="POST" name="formUpdate" role="form" id="form-edit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="hidden" name="public_id" id="public_id">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" id="harga" placeholder="Price" name="harga"
                                required min="1" max="100000">
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" class="form-control" id="stock" placeholder="Stock" name="stock"
                                required min="1">
                        </div>
                        <div class="form-group">
                            <label for="UploadImage">File Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="UploadImage" name="image">
                                    <label class="custom-file-label" for="UploadImage">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    <script>
        function deleteRow(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('#data-' + id).submit();
                }
            })
        };

    </script>
    <script>
        function edit(id) {
            $('#editModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/product/" + id + "/edit",
                success: function (response) {
                    $('#form-edit').attr('action', `/product/${id}`)
                    $('#name').val(response.data.name);
                    $('#product_id').val(response.data.id);
                    $('#harga').val(response.data.harga);
                    $('#stock').val(response.data.stock);
                    // $('#UploadImage').val(response.data.image);
                }
            })
        }

    </script>
