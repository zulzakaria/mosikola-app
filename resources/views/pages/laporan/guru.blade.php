@extends('layouts.blank')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

<body>
    <?php
    $date1 = date_create($periode->awal);
    $date2 = date_create($periode->akhir);
    ?>
    <div class="container">
        <p class="h4">Laporan Capaian Pelaksanaan Pembelajaran</p>
        <p class="h5">Periode Pendataan : {{ $periode->nama }} | {{ date_format($date1, 'd-M-Y') }} s/d
            {{ date_format($date2, 'd-M-Y') }} </p>
        <p><code>Data ini dihitung berdasarkan isian Jurnal Pembelajaran melalui aplikasi</code></p>
        <table id="example1" class="table table-bordered text-center">
            <caption>
                Laporan Capaian Pelaksanaan Pembelajaran<br>
                Periode Pendataan : {{ $periode->nama }} | {{ date_format($date1, 'd-M-Y') }} s/d
            {{ date_format($date2, 'd-M-Y') }}<br>
            Data ini dihitung berdasarkan isian Jurnal Pembelajaran melalui aplikasi</code>
            </caption>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nama Guru</td>
                    <td>Target JP Periode Ini</td>
                    <td>Capaian JP Periode Ini</td>
                    <td>Presentase Capaian</td>
                    <td>Lihat Detil</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($tampil as $t)
                    <tr>
                        <td>{{ $t['id'] }}</td>
                        <td>{{ $t['nama'] }}</td>
                        <td>{{ $a = $t['target'] }}</td>
                        <td>{{ $b = $t['juml'] }}</td>
                        <td>
                            @php
                                if ($a == 0) {
                                    $data = -1;
                                } elseif ($b == 0) {
                                    $data = 0;
                                } else {
                                    $data = round(($b / $a) * 100, 0);
                                }

                                if ($data < 10) {
                                    $color = 'bg-danger';
                                } elseif ($data < 30) {
                                    $color = 'bg-warning';
                                } elseif ($data < 80) {
                                    $color = 'bg-info';
                                } else {
                                    $color = 'bg-success';
                                }
                            @endphp
                            @if ($data >= 0)
                                {{ $data }} %
                                <div class="progress">
                                    <div class="progress-bar {{ $color }}" role="progressbar"
                                        style="width: {{ $data }}%;" aria-valuenow="{{ $data }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            @else
                                {{ 'Data target Belum diisi' }}
                            @endif
                            </td>
                            <td><a href="/laporan/guru/{{ $t['id'] }}" target="_blank"
                                class="btn btn-sm btn-success">Cek</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
