@extends('layouts.main')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Guru</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Guru</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Guru</h3> <a href="/guru/create" class="btn btn-md btn-success float-sm-right">+ Tambah Akun Guru</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Id [username]</th>
                                            <th>Password <br>[default:12345]</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>Status</th>
                                            <th>Aksi#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    @if ($item->password == '12345')
                                                        {{'*****' }}
                                                    @else
                                                        <b class="badge bg-success">Password sudah diubah</b>
                                                    @endif
                                                </td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>
                                                    @if ($item->aktif == 1)
                                                        <b class="badge bg-success">Aktif</b>
                                                    @else
                                                        <b class="badge bg-secondary">Tidak Aktif</b>
                                                    @endif
                                                </td>
                                                <td>
                                                   
                                                    @if ($item->aktif == 1)
                                                        <form action="/guru/nonAktifkan" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value={{$item->id }}>
                                                            <input type="submit" value="Non-Aktifkan Akun" class="btn btn-sm btn-danger">
                                                        </form>
                                                        
                                                    @else
                                                        <form action="/guru/aktifkan" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value={{$item->id }}>
                                                            <input type="submit" value="Aktifkan Akun" class="btn btn-sm btn-warning">
                                                        </form>
                                                    @endif
                                                     @if ($item->aktif == 1)
                                                        @if ($item->password != '12345')
                                                            <form action="/guru/resetPassword" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id" value={{$item->id }}>
                                                                <input type="submit" value="Reset Password" class="btn btn-sm btn-primary">
                                                            </form>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Id</th>
                                            <th>Password</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>Status</th>
                                            <th>Aksi#</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
