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
                            <li class="breadcrumb-item active">Rekap Per Bulan</li>
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
                                <h1>Rekapitulasi Data Per Bulan</h1>
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
                                <table id="example1" class="table table-bordered table-striped">
                                    <caption id="caption" class="bg-info">
                                        Rekap Bulan {{ date('M Y') }}
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Target</th>
                                            <th>Capaian</th>
                                            <th>Persentase Capaian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($capaian_ar as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item['nama'] }}</td>
                                                <td>
                                                    {{ $item['target'] . ' JP' }}
                                                </td>
                                                <td>
                                                    {{ $item['capaian'] . ' JP' }}
                                                </td>
                                                <td>
                                                    {{ $item['persen'] }}%
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Target</th>
                                            <th>Capaian</th>
                                            <th>Persentase Capaian</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var tabel_guru = $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $(function() {
            
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

        $('#range').daterangepicker({
            timePicker: false,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY'
            }
        })

        async function filter(){
            let dpick_startDate = $("#range").data('daterangepicker').startDate._d;
            let dpick_endDate = $("#range").data('daterangepicker').endDate._d;

            let startDate = dpick_startDate.getFullYear() + "-"  +(dpick_startDate.getMonth() + 1) + "-" + dpick_startDate.getDate();
            let endDate = dpick_endDate.getFullYear() + "-"  +(dpick_endDate.getMonth() + 1) + "-" + dpick_endDate.getDate();

            
            if(dpick_startDate.getDay() === 1 && dpick_endDate.getDay() === 5){
                         
                
                const options = {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token').value
                    },
                    body: JSON.stringify({
                        startDate: startDate,
                        endDate: endDate
                    })
                }

                try {
                    const response = await fetch('{{ route("laporan.perbulan.filter") }}', options);

                    if (!response.ok) {
                        console.error(`Error: ${response.statusText}`);
                        return;
                    }

                    const data = await response.json();
                    $("#example1").DataTable().clear()
                    $("#example1").DataTable().rows.add(data.data).draw();
                    document.getElementById("caption").innerHTML=`Rekap Data Rentang Tanggal ${startDate} sampai dengan ${endDate}`;

                }catch(e) {
                    console.error(e);
                }
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Hari Tidak Valid",
                    text: "Silakan Pilih Hari Senin & Jumat",
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
                // window.location.reload();
            }
        }
    </script>
@endsection
