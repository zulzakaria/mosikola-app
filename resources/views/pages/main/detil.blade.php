<!doctype html>
<html lang="en">
  <head>
  	<title>MoSiKoLa-App-v1</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- <link rel="stylesheet" href="{{asset('/css/style.css')}}"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	</head>

	<body class="bg-light">
        <p></p><p></p><p></p>
		<div class="container">
            <div class="card" style="">
                <div class="card-header">
                  {{ $sekolah->appName }}<br/>{{ $sekolah->nama }} &copy; {{ $app->year }}
                  
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><h2>Informasi Detail Pembelajaran</h2></li>
                    <li class="list-group-item">Tanggal : {{$tampil->tanggal}}</li>
                  <li class="list-group-item">Kelas : {{$tampil->nama_kelas}}<br/>
                  Guru Pengajar : {{$tampil->nama_guru}}<br/>
                  Mata Pelajaran : {{$tampil->nama_mapel}}<br/>
                 Tempat Belajar : {{$tampil->nama_lokasi}}<br/>
                  <li class="list-group-item">Topik/Materi Pembelajaran : {{$tampil->ket}}</li>
                  <li class="list-group-item">Jumlah Siswa Terdata : {{$tampil->juml}}<br/>
                  Jumlah Siswa yang Hadir : {{$tampil->hadir}}</li>
                  @if($tampil->foto == null)
                  <li class="list-group-item"><img src="../img/no_image.jpg" class="card-img-top img-thumbnail " style="width: 400px;"></li>
                  @else
                  <li class="list-group-item"><img src="../jurnal_img/{{$tampil->foto}}" class="card-img-top img-thumbnail " style="width: 400px;"></li>
                  @endif
                </ul>
                
              </div>
              <div class="card-footer">
                <a href="javascript:window.open('','_self').close();" class="btn btn-md btn-success">Kembali</a>
              </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>