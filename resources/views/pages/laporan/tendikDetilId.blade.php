@extends('layouts.blank')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

<body class="bg-light">
    <?php
    $date1 = date_create($periode->awal);
    $date2 = date_create($periode->akhir);
    ?>

    <div class="container">
        <div class="container">
            <h2>Aplikasi {{ $sekolah->appNameShort }}</h2>
            <h4>Jurnal Kegiatan Tenaga Kependidikan</h4>
            <hr>
            <?php
            use Carbon\Carbon;
            setlocale(LC_TIME, 'id_ID');
            \Carbon\Carbon::setLocale('id');
            \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y');
            $today = Carbon::now()->isoFormat('dddd, D MMM Y ');
            echo 'Waktu Saat ini : ' . $today . ' ' . date('H:i:s');
            ?>
        </div>
    </div>
    <p>
        <hr>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                @php
                    $i = 1;
                @endphp
                @php
                    $dt = date_create($k->tanggal);
                @endphp
                <tr>
                    <td>Nama Tendik</td> 
                    <td>:</td>
                    <td>{{$cek->nama}}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ date_format($dt, 'd F Y') }}</td>
                </tr>
                <tr>
                    <td>Waktu Mulai - Selesai</td>
                    <td>:</td>
                    <td>{{ $k->awal }} - {{ $k->akhir }}</td>
                </tr>
                <tr>
                    <td>Lokasi Kegiatan</td>
                    <td>:</td>
                    <td>{{ $k->lokasi }}</td>
                </tr>
                <tr>
                    <td>Uraian Kegiatan</td>
                    <td>:</td>
                    <td>{{ $k->kegiatan }}</td>
                </tr>
                <tr>
                    <td>Dokumentasi Kegiatan</td>
                    <td>:</td>
                    <td>
                        @if ($k->foto == null)
                            <font color="red">Tidak ada lampiran foto</font>
                        @else
                            <img src="/jurnal_tendik/{{ $k->foto }}" class="card-img-top img-thumbnail "
                                style="width: 600px;">
                        @endif
                    </td>
                </tr>

            </table>
            <div class="card-footer">
                <a href="javascript:window.open('','_self').close();" class="btn btn-md btn-success">Kembali</a>
              </div>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">Developed By {{ $app->dev }} - &copy; {{ $app->year }}</p>
    </footer>

</body>
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
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 150
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
