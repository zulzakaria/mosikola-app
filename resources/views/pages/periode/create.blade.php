@extends('layouts.main')

@section('content')
    <div class="content-wrapper" style="min-height: 2171.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Periode Perhitungan Sistem</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Periode Perhitungan</li>
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
                                <h3 class="card-title">Form Tambah Periode Perhitungan Sistem</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('periode.store') }}" method="POST">
                                @method('post')
                                @csrf
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-danger">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label>Nama Periode</label>
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Contoh : Semester 1 - T.P. 2023/2024" value="{{old('nama')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Awal Periode</label>
                                        <input type="date" class="form-control" name="awal"
                                            placeholder="Isi dengan tingkatan kelas [10 / 11 / 12]" value="{{old('awal')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Akhir Periode</label>
                                        <input type="date" class="form-control" name="akhir"
                                            placeholder="Isi dengan tingkatan kelas [10 / 11 / 12]" value="{{old('akhir')}}" required>
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
