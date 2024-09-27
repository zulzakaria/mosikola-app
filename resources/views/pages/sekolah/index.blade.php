@extends('layouts.main')

@section('content')
    <div class="content-wrapper" style="min-height: 2171.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">

            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Identitas Sekolah</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form action="/sekolah/update" method="POST">
                                @method('post')
                                @csrf
                                <input type="hidden" name="id" value="{{ $sp->id }}">
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">NPSN</label>
                                        <input type="text" class="form-control" name="npsn"
                                            value="{{ $sp->npsn }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nama Sekolah</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ $sp->nama }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nama Kepala Sekolah</label>
                                        <input type="text" class="form-control" name="kepsek"
                                            value="{{ $sp->kepsek }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Alamat Lengkap</label>
                                        <input type="text" class="form-control" name="alamat"
                                            value="{{ $sp->alamat }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Email Sekolah</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $sp->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nomor Telepon Sekolah</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $sp->phone }}">
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Identitas Aplikasi (Nama Lengkap)</label>
                                        <input type="text" class="form-control" name="appName"
                                            value="{{ $sp->appName }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Singkatan Aplikasi</label>
                                        <input type="text" class="form-control" name="appNameShort"
                                            value="{{ $sp->appNameShort }}">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
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
