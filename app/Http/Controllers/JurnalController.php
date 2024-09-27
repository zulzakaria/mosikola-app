<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Kbm;
use App\Models\Lokasi;
use App\Models\Status;
use App\Models\Periode;
use App\Models\Sekolah;
use App\Models\App;
use App\Models\Config;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Image;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->session()->has('id_guru')){
			
            $sekolah = Sekolah::findOrFail('1');
            $config = Config::findOrFail('1');
            $app = DB::table('app')->where('id','=','1')->first();
            $skrg = Carbon::now()->dayOfWeek;
            $tanggal = Carbon::now()->format('Y-m-d');
            $kelas = Kelas::all();
            $mapel = Mapel::all();
            $lokasi = Lokasi::where('id','>',0)->get();
            $periode = Periode::where('aktif','=','1')->first();
            
            $id_guru = $request->session()->get('id_guru');
            
            $cek = Guru::where('id','=',$id_guru)->first();
            // dd($cek);

                $kbm = Kbm::where('id_guru','=',$id_guru)
                ->select('kbm.id as id', 'kbm.id_jp','kbm.id_mapel','kbm.id_kls','kbm.id_lokasi','kbm.id_status','kbm.id_guru','kbm.tanggal','kbm.foto','mapel.nama as nama_mapel','kbm.juml','kbm.hadir','lokasi.nama_lokasi','kelas.nama as nama_kelas','kbm.ket','mapel.singkatan','kbm.desk_status')
                    ->join('mapel','kbm.id_mapel','=','mapel.id')
                    ->join('kelas','kbm.id_kls','=','kelas.id')
                    ->join('lokasi','kbm.id_lokasi','=','lokasi.id')
                    ->orderBy('kbm.tanggal', 'DESC')
                    ->orderBy('kbm.id_jp', 'ASC')
                    ->where('id_status','<=','2')
                    ->whereBetween('kbm.tanggal', [$periode->awal, $periode->akhir])     
                    ->get();
                return view('pages.jurnal.create2',compact(['sekolah','config','app','kelas','mapel','tanggal','skrg','cek','kbm','lokasi']));
                echo $request->session()->get('nama');
        }else{
            return redirect('/jurnal/login');
        }
    }

    public function umum(Request $request)
    {
        if($request->session()->has('id_guru')){
			
            $sekolah = Sekolah::findOrFail('1');
            $app = DB::table('app')->where('id','=','1')->first();
            $skrg = Carbon::now()->dayOfWeek;
            $tanggal = Carbon::now()->format('Y-m-d');   
            $kelas = Kelas::where('tingkat','>','12')->get();
            $mapel = Mapel::all();
            $lokasi = Lokasi::where('id','>',0)->get();
            $periode = Periode::where('aktif','=','1')->first();
            
            $id_guru = $request->session()->get('id_guru');
            
            $cek = Guru::where('id','=',$id_guru)->first();
            // dd($cek);

                $kbm = Kbm::where('id_guru','=',$id_guru)
                ->select('kbm.id as id', 'kbm.id_jp','kbm.id_mapel','kbm.id_kls','kbm.id_lokasi','kbm.id_status','kbm.id_guru','kbm.tanggal','kbm.foto','mapel.nama as nama_mapel','kbm.juml','kbm.hadir','lokasi.nama_lokasi','kelas.nama as nama_kelas','kbm.ket','mapel.singkatan','kbm.desk_status')
                    ->join('mapel','kbm.id_mapel','=','mapel.id')
                    ->join('kelas','kbm.id_kls','=','kelas.id')
                    ->join('lokasi','kbm.id_lokasi','=','lokasi.id')
                    ->orderBy('kbm.tanggal', 'DESC')
                    ->orderBy('kbm.id_jp', 'ASC')
                    ->where('id_status','<=','2')
                    ->whereBetween('kbm.tanggal', [$periode->awal, $periode->akhir])     
                    ->get();
                return view('pages.jurnal.umum',compact(['sekolah','app','kelas','mapel','tanggal','skrg','cek','kbm','lokasi']));
                echo $request->session()->get('nama');
        }else{
            return redirect('/jurnal/login');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_jp = $request->id_jp;
        
        $dari = $request->dari;
        if($dari >= 10){
            $dr = 0;
            $id_jp = $id_jp . $dr;
        }else{
            $dr = $dari;
            $id_jp = $id_jp-1 . $dr;
        }
        $ke = $request->ke;

        if($dari > $ke){
            return redirect('/jurnal')->with('status', 'Kesalahan penginputan Jam Pelajaran!');
        }

        if($request->hadir > $request->juml){
            return redirect('/jurnal')->with('status', 'Jumlah siswa hadir melebihi jumlah siswa perkelas');
        }

        if($request->hadir > 40 || $request->juml > 40){
            return redirect('/jurnal')->with('status', 'Jumlah siswa melebihi ketentuan.');
        }

        if($request->hasFile('foto')) {
            $originalImage= $request->file('foto');
            $image = Image::make($originalImage);
            $path = public_path().'/jurnal_img/';
            $image->resize(600,400, function ($constraint) {
                $constraint->aspectRatio();
            });
            $acak = rand(2,9);
            // $image->save($path.time().$originalImage->getClientOriginalName()); 
            $image->save($path.time()."_".$acak.".".$originalImage->getClientOriginalExtension()); 
            $nm_file = time()."_".$acak.".".$originalImage->getClientOriginalExtension();
            
        }else{
            $nm_file = null;
        }
        
        for($i = $dari; $i <= $ke; $i++){
             
            $request['id_jp'] = $id_jp;
            $kbm = new Kbm;

            $kbm->id_jp = $request->id_jp;
            $kbm->id_guru = $request->id_guru;
            $kbm->id_kls = $request->id_kls;
            $kbm->id_mapel = $request->id_mapel;
            $kbm->id_lokasi = $request->id_lokasi;
            $kbm->ket = $request->ket;
            $kbm->juml = $request->juml;
            $kbm->hadir = $request->hadir;
            $kbm->id_status = $request->id_status;
            $kbm->tanggal = $request->tanggal;
            $kbm->foto = $nm_file;

            $kbm->save();
            $id_jp = $id_jp + 1;
        }      
        return redirect('/jurnal')->with('sukses', 'Terimakasih. Data Berhasil di Simpan.');
    }

    public function storeUmum(Request $request)
    {
        $tgl_carbon = Carbon::createFromFormat('Y-m-d', $request->tanggal); 
        // dd($tgl_carbon->dayOfWeek);

        if($tgl_carbon->dayOfWeek == 0 || $tgl_carbon->dayOfWeek == 6){
            $mes = "Gagal, tanggal yang anda pilih adalah hari libur!";
            return redirect('/jurnal/umum')->with('status', $mes);
        }

        $id_jp = $request->id_jp;
        
        $dari = $request->dari;
        if($dari >= 10){
            $dr = 0;
            $id_jp = $id_jp . $dr;
        }else{
            $dr = $dari;
            $id_jp = $id_jp-1 . $dr;
        }
        $ke = $request->ke;

        $h1 = strtotime($request->tanggal);
        $h2 = strtotime("now");

        
        
        if($h1 > $h2){
            $mes = "Belum saatnya mengisi jurnal untuk tanggal $request->tanggal";
            return redirect('/jurnal/umum')->with('status', $mes);
        }


        if($dari > $ke){
            return redirect('/jurnal/umum')->with('status', 'Kesalahan penginputan Jam Pelajaran!');
        }

        if($request->hadir > $request->juml){
            return redirect('/jurnal/umum')->with('status', 'Jumlah siswa hadir melebihi jumlah siswa perkelas');
        }

        if($request->hadir > 40 || $request->juml > 40){
            return redirect('/jurnal/umum')->with('status', 'Jumlah siswa melebihi ketentuan.');
        }

        if($request->hasFile('foto')) {
            $originalImage= $request->file('foto');
            $image = Image::make($originalImage);
            $path = public_path().'/jurnal_img/';
            $image->resize(600,400, function ($constraint) {
                $constraint->aspectRatio();
            });
            $acak = rand(2,9);
            // $image->save($path.time().$originalImage->getClientOriginalName()); 
            $image->save($path.time()."_".$acak.".".$originalImage->getClientOriginalExtension()); 
            $nm_file = time()."_".$acak.".".$originalImage->getClientOriginalExtension();
            
        }else{
            $nm_file = null;
        }
        
        for($i = $dari; $i <= $ke; $i++){
             
            $request['id_jp'] = $id_jp;
            $kbm = new Kbm;

            $kbm->id_jp = $request->id_jp;
            $kbm->id_guru = $request->id_guru;
            $kbm->id_kls = $request->id_kls;
            $kbm->id_mapel = $request->id_mapel;
            $kbm->id_lokasi = $request->id_lokasi;
            $kbm->ket = $request->ket;
            $kbm->juml = $request->juml;
            $kbm->hadir = $request->hadir;
            $kbm->id_status = $request->id_status;
            $kbm->tanggal = $request->tanggal;
            $kbm->foto = $nm_file;

            $kbm->save();
            $id_jp = $id_jp + 1;
        }      
        return redirect('/jurnal/umum')->with('sukses', 'Terimakasih. Data Berhasil di Simpan.');
    }

    public function lampau(Request $request)
    {
        $cek = Config::where('id','=',1)->first();
        if ($cek->lampau == 0){
            return redirect('/jurnal');
        }
        
        if($request->session()->has('id_guru')){
			
            $sekolah = Sekolah::findOrFail('1');
            $app = DB::table('app')->where('id','=','1')->first();
            $skrg = Carbon::now()->dayOfWeek;
            $tanggal = Carbon::now()->format('Y-m-d');   
            $kelas = Kelas::all();
            $mapel = Mapel::all();
            $lokasi = Lokasi::where('id','>',0)->get();
            $periode = Periode::where('aktif','=','1')->first();
            
            $id_guru = $request->session()->get('id_guru');
            
            $cek = Guru::where('id','=',$id_guru)->first();
            // dd($cek);

                $kbm = Kbm::where('id_guru','=',$id_guru)
                ->select('kbm.id as id', 'kbm.id_jp','kbm.id_mapel','kbm.id_kls','kbm.id_lokasi','kbm.id_status','kbm.id_guru','kbm.tanggal','kbm.foto','mapel.nama as nama_mapel','kbm.juml','kbm.hadir','lokasi.nama_lokasi','kelas.nama as nama_kelas','kbm.ket','mapel.singkatan','kbm.desk_status')
                    ->join('mapel','kbm.id_mapel','=','mapel.id')
                    ->join('kelas','kbm.id_kls','=','kelas.id')
                    ->join('lokasi','kbm.id_lokasi','=','lokasi.id')
                    ->orderBy('kbm.tanggal', 'DESC')
                    ->orderBy('kbm.id_jp', 'ASC')
                    ->where('id_status','<=','2')
                    ->whereBetween('kbm.tanggal', [$periode->awal, $periode->akhir])     
                    ->get();
                return view('pages.jurnal.umum',compact(['sekolah','app','kelas','mapel','tanggal','skrg','cek','kbm','lokasi']));
                echo $request->session()->get('nama');
        }else{
            return redirect('/jurnal/login');
        }
    }

    public function storeLampau(Request $request)
    {
        $tgl_carbon = Carbon::createFromFormat('Y-m-d', $request->tanggal); 
        // dd($tgl_carbon->dayOfWeek);

        if($tgl_carbon->dayOfWeek == 0 || $tgl_carbon->dayOfWeek == 6){
            $mes = "Gagal, tanggal yang anda pilih adalah hari libur!";
            return redirect('/jurnal/lampau')->with('status', $mes);
        }

        $id_jp = $request->id_jp;
        
        $dari = $request->dari;
        if($dari >= 10){
            $dr = 0;
            $id_jp = $id_jp . $dr;
        }else{
            $dr = $dari;
            $id_jp = $id_jp-1 . $dr;
        }
        $ke = $request->ke;

        $h1 = strtotime($request->tanggal);
        $h2 = strtotime("now");

        
        
        if($h1 > $h2){
            $mes = "Belum saatnya mengisi jurnal untuk tanggal $request->tanggal";
            return redirect('/jurnal/lampau')->with('status', $mes);
        }


        if($dari > $ke){
            return redirect('/jurnal/lampau')->with('status', 'Kesalahan penginputan Jam Pelajaran!');
        }

        if($request->hadir > $request->juml){
            return redirect('/jurnal/lampau')->with('status', 'Jumlah siswa hadir melebihi jumlah siswa perkelas');
        }

        if($request->hadir > 40 || $request->juml > 40){
            return redirect('/jurnal/lampau')->with('status', 'Jumlah siswa melebihi ketentuan.');
        }

        if($request->hasFile('foto')) {
            $originalImage= $request->file('foto');
            $image = Image::make($originalImage);
            $path = public_path().'/jurnal_img/';
            $image->resize(600,400, function ($constraint) {
                $constraint->aspectRatio();
            });
            $acak = rand(2,9);
            // $image->save($path.time().$originalImage->getClientOriginalName()); 
            $image->save($path.time()."_".$acak.".".$originalImage->getClientOriginalExtension()); 
            $nm_file = time()."_".$acak.".".$originalImage->getClientOriginalExtension();
            
        }else{
            $nm_file = null;
        }
        
        for($i = $dari; $i <= $ke; $i++){
             
            $request['id_jp'] = $id_jp;
            $kbm = new Kbm;

            $kbm->id_jp = $request->id_jp;
            $kbm->id_guru = $request->id_guru;
            $kbm->id_kls = $request->id_kls;
            $kbm->id_mapel = $request->id_mapel;
            $kbm->id_lokasi = $request->id_lokasi;
            $kbm->ket = $request->ket;
            $kbm->juml = $request->juml;
            $kbm->hadir = $request->hadir;
            $kbm->id_status = $request->id_status;
            $kbm->tanggal = $request->tanggal;
            $kbm->foto = $nm_file;

            $kbm->save();
            $id_jp = $id_jp + 1;
        }      
        return redirect('/jurnal/lampau')->with('sukses', 'Terimakasih. Data Berhasil di Simpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $kbm = Kbm::findOrFail($request->id);
        $kbm->delete();
        return redirect('/jurnal')->with('sukses','Berhasil menghapus');
    }
}
