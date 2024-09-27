<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tendik;
use App\Models\JurnalTendik;
use App\Models\Periode;
use App\Models\Sekolah;
use App\Models\App;
use App\Models\Config;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Image;

class JurnalTendikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->session()->has('id_tendik')){
			
            $sekolah = Sekolah::findOrFail('1');
            $config = Config::findOrFail('1');
            $app = DB::table('app')->where('id','=','1')->first();
            $skrg = Carbon::now()->dayOfWeek;
            $tanggal = Carbon::now()->format('Y-m-d');   
            $periode = Periode::where('aktif','=','1')->first();
            
            $id_tendik = $request->session()->get('id_tendik');
            
            $cek = Tendik::where('id','=',$id_tendik)->first();
            // dd($cek);

                $kegiatan = JurnalTendik::where('id_tendik','=',$id_tendik)->orderBy('id','DESC')->take(20)->get();
                return view('pages.jurnalTendik.create',compact(['sekolah','config','app','tanggal','skrg','cek','kegiatan']));
                echo $request->session()->get('nama');
        }else{
            return redirect('/jurnal/tendik/login');
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
        
        $dari = $request->awal;
        $ke = $request->akhir;

        if($dari > $ke){
            return redirect('/jurnal/tendik')->with('status', 'Kesalahan penginputan Mulai dan Selesai');
        }

        if($request->hasFile('foto')) {
            $originalImage= $request->file('foto');
            $image = Image::make($originalImage);
            $path = public_path().'/jurnal_tendik/';
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
        
        $kegiatan = JurnalTendik::create([
            'id_tendik' => $request->id_tendik,
            'awal' => $request->awal,
            'akhir' => $request->akhir,
            'tanggal' => $request->tanggal,
            'foto' => $nm_file,
            'kegiatan' => $request->kegiatan,
            'lokasi' => $request->lokasi
        ]);

        return redirect('/jurnal/tendik')->with('sukses', 'Terimakasih. Data Berhasil di Simpan.');
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
        $kbm = JurnalTendik::findOrFail($request->id);
        $kbm->delete();
        return redirect('/jurnal/tendik')->with('sukses','Berhasil menghapus');
    }

    public function indexLampau(Request $request)
    {
        $cek = Config::where('id','=',1)->first();
        if ($cek->lampau == 0){
            return redirect('/jurnal/tendik');
        }

        if($request->session()->has('id_tendik')){
			
            $sekolah = Sekolah::findOrFail('1');
            $config = Config::findOrFail('1');
            $app = DB::table('app')->where('id','=','1')->first();
            $skrg = Carbon::now()->dayOfWeek;
            $tanggal = Carbon::now()->format('Y-m-d');   
            $periode = Periode::where('aktif','=','1')->first();
            
            $id_tendik = $request->session()->get('id_tendik');
            
            $cek = Tendik::where('id','=',$id_tendik)->first();
            // dd($cek);

                $kegiatan = JurnalTendik::where('id_tendik','=',$id_tendik)->orderBy('id','DESC')->take(20)->get();
                return view('pages.jurnalTendik.lampau',compact(['sekolah','config','app','tanggal','skrg','cek','kegiatan']));
                echo $request->session()->get('nama');
        }else{
            return redirect('/jurnal/tendik/login');
        }
    }

    public function storeLampau(Request $request)
    {
        
        $dari = $request->awal;
        $ke = $request->akhir;

        if($dari > $ke){
            return redirect('/jurnal/tendik/lampau')->with('status', 'Kesalahan penginputan Mulai dan Selesai');
        }

        if($request->hasFile('foto')) {
            $originalImage= $request->file('foto');
            $image = Image::make($originalImage);
            $path = public_path().'/jurnal_tendik/';
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
        
        $kegiatan = JurnalTendik::create([
            'id_tendik' => $request->id_tendik,
            'awal' => $request->awal,
            'akhir' => $request->akhir,
            'tanggal' => $request->tanggal,
            'foto' => $nm_file,
            'kegiatan' => $request->kegiatan,
            'lokasi' => $request->lokasi
        ]);

        return redirect('/jurnal/tendik/lampau')->with('sukses', 'Terimakasih. Data Berhasil di Simpan.');
    }

}
