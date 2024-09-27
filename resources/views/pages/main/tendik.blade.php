<!doctype html>
<html lang="en">

<head>
    <title>{{ $app->shortName }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link rel="stylesheet" href="{{ asset('/css/style.css') }}"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="bg-light">
    <div class="container-fluit">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Monitoring Kegiatan Tenaga Kependidikan<br />
                    {{ $sekolah->nama }}</h4>
                <h5 style="color: rgb(4, 111, 168);">
                    <?php
                    use Carbon\Carbon;
                    use App\Models\JurnalTendik;
                    setlocale(LC_TIME, 'id_ID');
                    \Carbon\Carbon::setLocale('id');
                    \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y');
                    $today = Carbon::now()->isoFormat('dddd, D MMM Y ');
                    echo 'Hari ini : ' . $today . ' ' . date('H:i:s');
                    ?>
                </h5>

                <div class="table-wrap">
                    <a href="/jurnal/tendik" class="btn btn-md btn-warning btn-block mb-4">Buat Jurnal Kegiatan</a>
                    {{-- <a href="/laporan/tendik" class="btn btn-md btn-info btn-block mb-4">Lihat Laporan Periode Ini</a> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered text-center ">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama Tendik</th>
                                    <th>Senin, {{ $tanggal[0] }}</th>
                                    <th>Selasa, {{ $tanggal[1] }}</th>
                                    <th>Rabu, {{ $tanggal[2] }}</th>
                                    <th>Kamis, {{ $tanggal[3] }}</th>
                                    <th>Jumat, {{ $tanggal[4] }}</th>
                                </tr>
                            </thead>
                            <tbody style="">
                                @foreach ($data as $index => $d)
                                    @php
                                        if ($index % 2 == 0) {
                                            $bg = 'background-color: rgb(247, 255, 230)';
                                        } else {
                                            $bg = 'background-color: rgb(230, 255, 242)';
                                        }
                                    @endphp
                                    <tr style="{{$bg}}">
                                        <td align="left" ><a href="/laporan/tendik/{{$d['id_tendik']}}" target="_blank" class="badge bg-info tt" style="text-decoration: none;" data-bs-toggle="tooltip" title="Klik untuk melihat jurnal kegiatan {{ $d['nama'] }}">cek</a> {{ $d['nama'] }}</td>
                                        @php
                                            $v = JurnalTendik::where('id_tendik', '=', $d['id_tendik'])
                                                ->orderBy('awal')
                                                ->get();
                                        @endphp
                                        @foreach ($tanggal as $index => $tg)
                                            <td align="left" style="{{$bg}}">
                                                @foreach ($v as $index => $i)
                                                    @if ($tg == $i->tanggal)
                                                        <a href="/laporan/tendik/detil/{{$i->id}}" target="_blank" class="badge bg-success tt" style="text-decoration: none;"
                                                            data-bs-toggle="tooltip"
                                                            title="{{ $i->kegiatan }}">{{ substr($i->awal,0,5) }} - {{ substr($i->akhir,0,5) }}</a>
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="51" style="text-align: left;"><code>Keterangan Tooltip : </code></th>
                                </tr>
                                <tr>
                                    <th colspan="51">
                                        <p class="mb-1">{{ $app->shortName }} &copy; {{ $app->year }} - Developed
                                            By {{ $app->dev }}</p>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <a href="/jurnal/tendik" class="btn btn-md btn-warning btn-block mb-4">Buat Jurnal Kegiatan</a>
                    {{-- <a href="/laporan/tendik" class="btn btn-md btn-info btn-block mb-4">Lihat Laporan Periode Ini</a> --}}
                </div>
            </div>
        </div>
    </div>


    <!-- <script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/popper.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/main.js') }}"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        const tooltips = document.querySelectorAll('.tt')
        tooltips.forEach(t => {
            new bootstrap.Tooltip(t)
        })
    </script>
</body>

</html>
