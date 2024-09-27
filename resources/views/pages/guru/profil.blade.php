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
        <p></p>
        <div class="card">
            <div class="card-header">
                <a href="/jurnal" class="btn btn-sm btn-warning"><< Kembali</a><h4>Update Profil Guru</h4>
            </div>
            <div class="card-body">
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
                <form action="/guru/profilUpdate" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $guru->id }}">
                    <div class="col-md-12">
                        <label for="formFile" class="form-label">Nama :</label>
                        <input class="form-control" type="text" name="nama" value="{{ $guru->nama }}">
                    </div>
                    <div class="col-md-12">
                        <label for="formFile" class="form-label">NIP :</label>
                        <input class="form-control" type="text" name="nip" value="{{ $guru->nip }}">
                    </div>
                    <div class="col-md-12">
                        <label for="formFile" class="form-label">Foto : </label><br>
                        @if ($guru->foto == null)
                            <img src="/ptk/no.jpg" class="card-img-top img-thumbnail " style="width: 200px;">
                        @else
                            <img src="/ptk/{{ $guru->foto }}" class="card-img-top img-thumbnail "
                                style="width: 200px;">
                        @endif
                        <input class="form-control" type="file" id="formFile" name="foto" accept=".jpg, .jpeg, .png">
                    </div>
                    <p>
                    <hr>
                    <div class="col-md-12">
                        <label for="formFile" class="form-label">Ubah Password :</label>
                        <input class="form-control" type="password" name="password" placeholder="Hanya diisi jika ingin merubah, Kosongkan saja jika tidak ingin merubah Password">
                    </div>
                    <br>
                    <div class="col-md-12">
                        <input class="btn btn-lg btn-success" type="submit" value="Simpan Perubahan Data">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2023 - Tim PPLG/RPL SMK Negeri 1 Limboto</p>
    </footer>
    </div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="form-validation.js"></script>
</body>

</html>
