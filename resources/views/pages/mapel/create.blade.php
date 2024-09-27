@extends('layouts.main')

@section('content')
    <div class="content-wrapper" style="min-height: 2171.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Mata Pelajaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Mata Pelajaran</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Tambah Mata Pelajaran</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('mapel.store')}}" method="POST">
                            @method('post')
                            @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Mata Pelajaran</label>
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Isi dengan nama lengkap Mata Pelajaran" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Singkatan</label>
                                        <input type="text" class="form-control" name="singkatan"
                                            placeholder="Isi dengan singkatan Mata Pelajaran">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="form-group">
                    </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </div>
    <!--/.col (right) -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
