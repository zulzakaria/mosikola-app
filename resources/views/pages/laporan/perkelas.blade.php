@extends('layouts.main')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style type="text/css">
        #example1 caption {
            caption-side: top;
            padding:10px;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Rekap Per Kelas</li>
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
                                <h1>Rekapitulasi Data Per Kelas</h1>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <!-- <form action="{{ route('laporan.perbulan.filter') }}" method="post">  
                                        -->
                                    <label>Date range:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    @csrf
                                    <input type="text" name="rentang" class="form-control float-right" id="range">
                                    <span class="input-group-append">
                                        <button class="btn btn-sm btn-primary" onclick="filter()" type="submit">Filter</button>
                                    </span>
                                <!-- </form> -->
                                </div>
                            </div>

                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center ">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Kelas</th>
                                                <th colspan="10">Senin</th>
                                                <th colspan="10">Selasa</th>
                                                <th colspan="10">Rabu</th>
                                                <th colspan="10">Kamis</th>
                                                <th colspan="10">Jumat</th>
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
                                                        <td style="">
                                                            -
                                                        </td>
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
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
<script>
     $('#range').daterangepicker({
        timePicker: false,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY'
        }
    })
</script>
@endsection