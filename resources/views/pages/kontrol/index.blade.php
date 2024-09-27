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
                                <h3 class="card-title">Kontrol Penginputan Data</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form action="/kontrol/update" method="POST">
                                @method('post')
                                @csrf
                                <input type="hidden" name="id" value="{{ $kontrol->id }}">
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <label>
                                            Izin Penginputan Lampau
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="lampau" value="1"
                                            id="flexRadioDefault1" @if ($kontrol->lampau == 1)
                                                @checked(true)
                                            @endif>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Aktif
                                        </label>
                                    </div>
                                    <code>Aktif : Mengizinkan User menginput data lampau</code>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="lampau" value="0"
                                            id="flexRadioDefault2" @if ($kontrol->lampau == 0)
                                                @checked(true)
                                            @endif>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Tidak Aktif
                                        </label>
                                    </div>
                                    <code>Tidak Aktif : Melarang User menginput data lampau</code>
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
