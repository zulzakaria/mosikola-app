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
            <h4>Jurnal Kegiatan Tenaga Kependidikan a.n. <strong>{{$cek->nama}}</strong></h4>
            <a href="javascript:window.open('','_self').close();" class="btn btn-md btn-success">Kembali</a>
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
            <table id="example1" class="table table-striped">
                <caption>
                    Laporan Kegiatan Tendik a.n. <strong>{{$cek->nama}}</strong><br>
                    Data ini diambil berdasarkan isian Jurnal Kegiatan melalui aplikasi
                    {{ $sekolah->appNameShort }}</code>
                </caption>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam (mulai - selesai)</th>
                        <th scope="col">Lokasi Kegiatan</th>
                        <th scope="col">Uraian Kegiatan</th>
                        <th scope="col">Dokumentasi Kegiatan</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $i = 1;
                    @endphp
                    @foreach ($jurnal as $k)
                    @php
                        $dt = date_create($k->tanggal);
                    @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ date_format($dt, 'd F Y') }}</td>
                            <td>{{ $k->awal }} - {{ $k->akhir }}</td>
                            <td>{{ $k->lokasi }}</td>
                            <td>{{ $k->kegiatan }}</td>
                            <td>
                                @if ($k->foto == null)
                                    <font color="red">Tidak ada lampiran foto</font>
                                @else
                                    <img src="/jurnal_tendik/{{ $k->foto }}" class="card-img-top img-thumbnail "
                                        style="width: 200px;">
                                @endif
                            </td>
                            @php
                                $i++;
                            @endphp
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
