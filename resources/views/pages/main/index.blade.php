<!doctype html>
<html lang="en">

<head>
    <title>Mosikola v.1.1</title>
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
                <h4 class="text-center mb-4">{{ $sekolah->appName }}<br />
                    {{ $sekolah->nama }}</h4>
                <h5 style="color: rgb(4, 111, 168);">
                    <?php
                    use Carbon\Carbon;
                    setlocale(LC_TIME, 'id_ID');
                    \Carbon\Carbon::setLocale('id');
                    \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y');
                    $today = Carbon::now()->isoFormat('dddd, D MMM Y ');
                    echo 'Hari ini : ' . $today . ' ' . date('H:i:s');
                    ?>
                </h5>

                <div class="table-wrap">
                    <a href="/jurnal" class="btn btn-md btn-warning btn-block mb-4">Buat Jurnal Mengajar</a>
                    <a href="/laporan/guru" class="btn btn-md btn-info btn-block mb-4">Lihat Laporan Periode Ini</a>
                    <a href="/tendik" class="btn btn-md btn-danger btn-block mb-4">Link khusus Tendik</a>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center ">
                            <thead>
                                <tr>
                                    <th rowspan="2">Kelas</th>
                                    <th colspan="10">Senin, {{ $tanggal[0] }}</th>
                                    <th colspan="10">Selasa, {{ $tanggal[1] }}</th>
                                    <th colspan="10">Rabu, {{ $tanggal[2] }}</th>
                                    <th colspan="10">Kamis, {{ $tanggal[3] }}</th>
                                    <th colspan="10">Jumat, {{ $tanggal[4] }}</th>
                                </tr>
                                <tr>
                                    <?php
                                    $jam = [1 => '7.15-8.00', 2 => '8.00-8.45', 3 => '8.45-9.30', 4 => '9.45-10.30', 5 => '10.30-11.15', 6 => '11.15-12.00', 7 => '12.30-13.15', 8 => '13.15-14.00', 9 => '14.15-15.00', 10 => '15.00-15.45'];
                                    ?>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <td><b>{{ $i }}</b>
                                            <br /><code style="font-size:3mm;">{{ $jam[$i] }}</code>
                                        </td>
                                    @endfor
                                    @for ($i = 1; $i <= 10; $i++)
                                        <td><b>{{ $i }}</b>
                                            <br /><code style="font-size:3mm;">{{ $jam[$i] }}</code>
                                        </td>
                                    @endfor
                                    @for ($i = 1; $i <= 10; $i++)
                                        <td><b>{{ $i }}</b>
                                            <br /><code style="font-size:3mm;">{{ $jam[$i] }}</code>
                                        </td>
                                    @endfor
                                    @for ($i = 1; $i <= 10; $i++)
                                        <td><b>{{ $i }}</b>
                                            <br /><code style="font-size:3mm;">{{ $jam[$i] }}</code>
                                        </td>
                                    @endfor
                                    @for ($i = 1; $i <= 10; $i++)
                                        <td><b>{{ $i }}</b>
                                            <br /><code style="font-size:3mm;">{{ $jam[$i] }}</code>
                                        </td>
                                    @endfor

                                </tr>
                            </thead>
                            <tbody style="">
                                @foreach ($kelas as $kl)
                                    @php
                                        if ($kl->id % 2 == 0) {
                                            $bg = 'background-color: rgb(218, 255, 253);';
                                        } else {
                                            $bg = 'background-color: rgb(181, 255, 251);';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $kl->nama }}</td>
                                        @for ($j = 1; $j <= 50; $j++)
                                            @foreach ($tampil as $t)
                                                @if ($j == $t->id_jp and $kl->id == $t->id_kls)
                                                    @php
                                                        if ($t->id_jp >= 1 and $t->id_jp <= 10) {
                                                            $x = 'background-color: rgb(153, 255, 153);';
                                                            $b = 'bg-success';
                                                        } elseif ($t->id_jp >= 11 and $t->id_jp <= 20) {
                                                            $x = 'background-color: rgb(204, 255, 102);';
                                                            $b = 'bg-primary';
                                                        } elseif ($t->id_jp >= 21 and $t->id_jp <= 30) {
                                                            $x = 'background-color: rgb(153, 255, 153);';
                                                            $b = 'bg-success';
                                                        } elseif ($t->id_jp >= 31 and $t->id_jp <= 40) {
                                                            $x = 'background-color: rgb(204, 255, 102);';
                                                            $b = 'bg-primary';
                                                        } else {
                                                            $x = 'background-color: rgb(153, 255, 153);';
                                                            $b = 'bg-success';
                                                        }
                                                    @endphp
                                                    <td style="{{$x}}">
                                                        {{-- <a href="javascript:void(0);" class="tt"
                                                            style="text-decoration: none; color:black;"
                                                            data-bs-toggle="tooltip"
                                                            title="{{ $t->id_guru }} | {{ $t->nama_kelas }} | {{ $t->nama_guru }} | {{ $t->nama_mapel }} | {{ $t->juml }}/{{ $t->hadir }} | {{ $t->nama_lokasi }} | {{ $t->ket }} ">{{ $t->singkatan }}</a> --}}
                                                        <a href="/detil/{{ $t->id }}" data-bs-toggle="tooltip" target="_blank"
                                                            class="badge {{$b}} tt" style="text-decoration: none;" title="{{ $t->id_guru }} | {{ $t->nama_kelas }} | {{ $t->nama_guru }} | {{ $t->nama_mapel }} | {{ $t->juml }}/{{ $t->hadir }} | {{ $t->nama_lokasi }} | {{ $t->ket }} ">{{ $t->singkatan }}</a>
                                                        {{-- <a href="/detil/{{ $t->id }}" target="_blank"
                                                            class="btn btn-sm btn-outline-danger"><i
                                                                class="fa fa-th-list" aria-hidden="true"></i></a> --}}
                                                    </td>

                                                    <?php
                                                    $j++;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($j > 50)
                                            @break

                                        @else
                                            <td style="{{ $bg }}">-</td>
                                        @endif
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="51" style="text-align: left;"><code>Keterangan Tooltip : id | Nama
                                        Guru | Jumlah Siswa Perkelas / Jumlah yang hadir | Lokasi Belajar | Uraian
                                        Materi/Kondisi KBM</code></th>
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
                <a href="/jurnal" class="btn btn-md btn-warning btn-block mb-4">Buat Jurnal Mengajar</a>
                <a href="/laporan/guru" class="btn btn-md btn-info btn-block mb-4">Lihat Laporan Periode Ini</a>
                <a href="/tendik" class="btn btn-md btn-danger btn-block mb-4">Link khusus Tendik</a>
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
