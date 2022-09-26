@extends('admin.index')
@section('content')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Form Editor</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Form Editor</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Ckeditor Classic editor</h4>
                                        <p class="card-title-desc">Example of Ckeditor Classic editor</p>
                                    </div>
                                    <div class="card-body">
                                    <form action="{{route('mejaAdd')}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="meja" class="form-label">Meja</label>
                                            <input type="number" class="form-control" name="no_meja">
                                            @error('meja')
                                            {{$message}}
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div>
@endsection