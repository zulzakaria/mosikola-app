@extends('layouts.main')

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengaturan Jam Pelajaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Jam Pelajaran</li>
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
                            <h3 class="card-title">Daftar Jam Pelajaran</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-12 col-sm-6">
                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">

                                    @php
                                    // dd($arr_jp[1][0]);
                                        $array_hari = array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat');
                                    @endphp
                                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                            @foreach($arr_jp as $hari => $jp)
                                            <li class="nav-item">
                                                <a class="nav-link {{ $hari == date('w') ? 'active' : ''}}" id=""
                                                    data-toggle="pill" href="#{{ $array_hari[$hari] . '-tab' }}" role="tab"
                                                    aria-controls="custom-tabs-four-home" aria-selected="true">{{ $array_hari[$hari] }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    {{-- {{dd($arr_jp2)}} --}}
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                            @foreach($arr_jp as $hari => $jp)
                                            <div class="tab-pane fade {{ $hari == date('w') ? 'active show' : ''}}" id="{{ $array_hari[$hari] . '-tab' }}"
                                            role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                                <table class="table table-bordered table-striped">
                                                    <tr class="text-center">
                                                        <th>Jam Ke</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    @foreach($jp as $val)
                                                        <tr class="text-center">
                                                            <td>{{ $val['jam_ke'] }}</td>
                                                            <td>
                                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                    <input onchange="gantiStatus(this, {{ $val['id'] }})" type="checkbox" {{ $val['status'] == '1' ? 'checked' : '' }} class="custom-control-input" id="swith-{{ $val['id'] }}">
                                                                    <label class="custom-control-label" for="swith-{{ $val['id'] }}">{{ $val['status'] == '1' ? 'Aktif' : 'Nonaktif' }}</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                    @endforeach
                                                </table>
                                               
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
     function gantiStatus(checkbox, id){
        
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Anda Akan Mengubah Status Jam Tersebut",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Batalkan'
        }).then(async (result) => {
            if(result.value){
                const options = {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token').value
                    },
                    body: JSON.stringify({
                        id_jp: id,
                        status: checkbox.checked
                    })
                }

                try {
                    const response = await fetch('{{ route("jam.ganti") }}', options);

                    if (!response.ok) {
                        console.error(`Error: ${response.statusText}`);
                        return;
                    }

                    const data = await response.json();
                    // console.log(data);
                    window.location.reload();
                    

                }catch(e) {
                    console.error(e);
                }
            }else{
                if(status === true){
                    document.getElementById(checkbox.id).checked = false
                }else{
                    document.getElementById(checkbox.id).checked = true
                }
            }
        });

        

        // console.log(checkbox.checked);
        // console.log(id);
     }
</script>
@endsection