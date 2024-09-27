<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Jp;
use App\Models\Sekolah;
use App\Models\Tendik;
use App\Models\JurnalTendik;

class MainController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $senin = $now->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $tambah = Carbon::createFromFormat('Y-m-d', $senin);
        $selasa = $tambah->addDays(1)->format('Y-m-d');
        $rabu = $tambah->addDays(1)->format('Y-m-d');
        $kamis = $tambah->addDays(1)->format('Y-m-d');
        $jumat = $tambah->addDays(1)->format('Y-m-d');
        $tanggal = [$senin,$selasa,$rabu,$kamis,$jumat];

        // $tampil = Kbm::whereBetween('tanggal', [$senin, $jumat])->get();
        $tampil = DB::table('kbm')
                    ->select('kbm.id as id', 'kbm.id_jp','kbm.id_mapel','kbm.id_kls','kbm.id_lokasi','kbm.id_status','kbm.id_guru','kbm.tanggal','kbm.foto','kelas.nama as nama_kelas','mapel.nama as nama_mapel','guru.nama as nama_guru','kbm.juml','kbm.hadir','lokasi.nama_lokasi','kbm.ket','mapel.singkatan')
                    ->join('mapel','kbm.id_mapel','=','mapel.id')
                    ->join('kelas','kbm.id_kls','=','kelas.id')
                    ->join('guru','kbm.id_guru','=','guru.id')
                    ->join('lokasi','kbm.id_lokasi','=','lokasi.id')
                    ->join('status','kbm.id_status','=','status.id')
                    ->join('jp','kbm.id_jp','=','jp.id')
                    ->where('id_status','<=','2')
                    ->whereBetween('kbm.tanggal', [$senin, $jumat])
                    ->orderBy('kbm.id_jp')
                    ->get();

        $kelas = Kelas::orderBy('tingkat','ASC')->get();
        $jp = Jp::all();
        $sekolah = Sekolah::findOrFail('1');
        $app = DB::table('app')->where('id','=','1')->first();

        return view('pages.main.index',compact(['app','sekolah','tampil','kelas','jp','tanggal']));
    }

    public function detil($id)
    {
        $sekolah = Sekolah::findOrFail('1');
        $app = DB::table('app')->where('id','=','1')->first();
        $tampil = DB::table('kbm')
                    ->select('kbm.id as id', 'kbm.id_jp','kbm.id_mapel','kelas.nama as nama_kelas','kbm.id_kls','kbm.id_lokasi','kbm.id_status','kbm.id_guru','kbm.tanggal','kbm.foto','mapel.nama as nama_mapel','guru.nama as nama_guru','kbm.juml','kbm.hadir','lokasi.nama_lokasi','kbm.ket','mapel.singkatan','status.nama_status','kbm.desk_status')
                    ->join('mapel','kbm.id_mapel','=','mapel.id')
                    ->join('kelas','kbm.id_kls','=','kelas.id')
                    ->join('guru','kbm.id_guru','=','guru.id')
                    ->join('lokasi','kbm.id_lokasi','=','lokasi.id')
                    ->join('status','kbm.id_status','=','status.id')
                    ->join('jp','kbm.id_jp','=','jp.id')
                    ->where('kbm.id', '=',$id)
                    ->first();

        return view('pages.main.detil',compact(['tampil','sekolah', 'app']));
    }

    public function tendik()
    {
        $now = Carbon::now();
        $senin = $now->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $tambah = Carbon::createFromFormat('Y-m-d', $senin);
        $selasa = $tambah->addDays(1)->format('Y-m-d');
        $rabu = $tambah->addDays(1)->format('Y-m-d');
        $kamis = $tambah->addDays(1)->format('Y-m-d');
        $jumat = $tambah->addDays(1)->format('Y-m-d');
        $tanggal = [$senin,$selasa,$rabu,$kamis,$jumat];

        $tendik = Tendik::where('aktif','=','1')->get();
        $data = [];

        foreach ($tendik as $index => $t){
            $data[$index] = [
                'id_tendik' => $t->id,
                'nama' => $t->nama
            ];
        }
        
        $sekolah = Sekolah::findOrFail('1');
        $app = DB::table('app')->where('id','=','1')->first();

        return view('pages.main.tendik',compact(['app','sekolah','data','tanggal','tendik']));
    }
}
