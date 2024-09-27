<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>{{ $app->shortName }}</title>

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
        <main>
            <div class="py-5 text-center">
                <h2>Selamat datang, <strong><i>{{ $cek->nama }}</strong></i> <a href="/jurnal/tendik/logout"
                        class="btn btn-sm btn-warning btn-block mb-4"><b>Logout</b></a></h2>
                <a href="/guru/profil" class="btn btn-lg btn-success">Update Profil PTK</a>
                <p class="lead">Silahkan isi Jurnal Kegiatan anda disini.</p>
                <?php
                use Carbon\Carbon;
                setlocale(LC_TIME, 'id_ID');
                \Carbon\Carbon::setLocale('id');
                \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y');
                $today = Carbon::now()->isoFormat('dddd, D MMM Y ');
                echo 'Tanggal Jurnal : ' . $today . ' ' . date('H:i:s');
                ?>
            </div>
            <div class="row g-5">
                <div class="col-md-12 col-lg-12">
                    @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('sukses'))
                        <div class="alert alert-success">
                            {{ session('sukses') }}
                        </div>
                    @endif
                    <form class="needs-validation" action="/jurnal/tendik/lampau/store" method="post" name="frmImage"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_tendik" value="{{ $cek->id }}">
                        <p></p>
                        <div class="col-md-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" class="form-control" required/>
                        </div>
                        <p></p>
                        <div class="col-md-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Lokasi Kegiatan</label>
                            <input type="text" name="lokasi" class="form-control" required/>
                        </div>
                        <p></p>
                        <div class="col-md-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Uraian Kegiatan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="kegiatan" required>
                            </textarea>
                        </div>
                        <p></p>
                        <div class="col-md-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Waktu Mulai Pekerjaan</label>
                            <input type="time" name="awal" class="form-control" required />
                        </div>
                        <p></p>
                        <div class="col-md-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Waktu Selesai Pekerjaan</label>
                            <input type="time" name="akhir" class="form-control" required />
                        </div>
                        <p></p>
                        <div class="col-md-12">
                            <label for="formFile" class="form-label">Lampiran Foto <code>***</code></label>
                            <input class="form-control" type="file" id="formFile" name="foto"
                                accept=".jpg, .jpeg, .png">
                        </div>
                        <div class="col-md-12">
                            <label for="formFile" class="form-label"><code>*** : Harap melampirkan foto anda & siswa
                                    di dalam kelas</code></label>
                        </div>
                </div>



                <button class="w-100 btn btn-primary btn-lg" type="submit" name="submit">Kirim Laporan
                    Kegiatan</button>
                </form>
            </div>

    </div>

    </main>
    <p>
    <p>
        <hr>
    <div class="container">
        <h2>Riwayat Kegiatan</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col"></th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Mulai - Selesai</th>
                    <th scope="col">Lokasi Kegiatan</th>
                    <th scope="col">Uraian Kegiatan</th>
                    <th scope="col">Dokumentasi</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $i = 1;
                @endphp
                @foreach ($kegiatan as $k)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>

                            <form action="{{ route('jurnal.tendik.destroy') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $k->id }}">
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Yakin menghapus data?')">Hapus</button>
                            </form>

                        </td>
                        <td>{{ $k->tanggal }}</td>
                        <td>{{ $k->awal }} - {{ $k->akhir }} </td>
                        <td>{{ $k->lokasi }}</td>
                        <td>{{ $k->kegiatan }}</td>
                        <td>
                            @if ($k->foto == null)
                                Tidak melampirkan foto kegiatan
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
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">{{ $app->shortName }} &copy; {{ $app->year }} - Develop By {{ $app->dev }}</p>
    </footer>
    </div>


</body>

</html>
