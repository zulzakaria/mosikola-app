<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>MoSiKoLa-App-v1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">



    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <div class="container">
            <h2>{{$sekolah->appShortName}}</h2>
            <h4>{{$sekolah->appName}}</h4>
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
        <p>
        <p>
            <hr>
        <table>
            <tr>
                <td rowspan="5">
                    @if ($cek->foto == null)
                        <img src="/ptk/no.jpg" class="card-img-top img-thumbnail " style="width: 200px;">
                    @else
                        <img src="/ptk/{{ $cek->foto }}" class="card-img-top img-thumbnail " style="width: 200px;">
                    @endif
                </td>
                <td>
                    <table>
                        <tr>
                            </td>
                            <td>NPSN </td>
                            <td>:</td>
                            <td>{{ $sekolah->npsn }}</td>
                        </tr>
                        <tr>
                            <td>Satuan Pendidikan </td>
                            <td>:</td>
                            <td>{{ $sekolah->nama }}</td>
                        </tr>
                        <tr>
                            <td>Nama PTK</td>
                            <td>:</td>
                            <td><strong>{{ $cek->nama }}</strong></td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td>{{ $cek->nip }}</td>
                        </tr>
                    </table>
                </td>
        </tr>
        <tr>

        </tr>
        </table>
    </div>
    <p>
    <p>
        <hr>
    <div class="container">
        <?php
        $date1 = date_create($periode->awal);
        $date2 = date_create($periode->akhir);
        ?>
        <h4>Riwayat Jurnal Kegiatan | Periode : {{ $periode->nama }} | {{ date_format($date1, 'd-M-Y') }} s/d
            {{ date_format($date2, 'd-M-Y') }}</h4>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jam Ke</th>
                        <th scope="col">Mata Pelajaran</th>
                        <th scope="col">Data Siswa</th>
                        <th scope="col">Lokasi Kegiatan</th>
                        <th scope="col">Lampiran Foto Kegiatan</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $i = 1;
                    @endphp
                    @foreach ($kbm as $k)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $k->tanggal }}</td>

                            <td>{{ $k->kelas->nama }}</td>
                            <td>
                                @php
                                    $jp = substr($k->id_jp, 1);
                                    if ($jp <= 0) {
                                        $jp = 10;
                                    } else {
                                        $jp = $jp;
                                    }
                                    echo $jp;
                                @endphp
                            </td>
                            <td><b>{{ $k->mapel->nama }}</b><br>
                                Materi : {{ $k->ket }}
                            </td>
                            <td>Jumlah : {{ $k->juml }} <br>
                                Hadir : {{ $k->hadir }} <br>
                                Presentasi Kehadiran : <b>
                                <?php
                                    if ($k->juml == 0 || $k->hadir == 0){
                                        echo 0;
                                    }else{
                                        echo round(($k->hadir / $k->juml) * 100, 2);
                                    }
                                ?>
                                    %</b></td>
                            <td>{{ $k->lokasi->nama_lokasi }}</td>
                            <td>
                                @if ($k->foto == null)
                                    <font color="red">Tidak ada lampiran foto</font>
                                @else
                                    <img src="/jurnal_img/{{ $k->foto }}" class="card-img-top img-thumbnail "
                                        style="width: 100px;">
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
    </div>
</body>

</html>
