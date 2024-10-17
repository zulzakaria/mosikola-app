<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Jp;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Tendik;
use App\Models\Kbm;
use App\Models\Lokasi;
use App\Models\Status;
use App\Models\Periode;
use App\Models\Sekolah;
use App\Models\Target;
use App\Models\JumlahPekan;
use App\Models\JurnalTendik;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function laporanGuru(){
        $periode = Periode::where('aktif','=','1')->first(); 
        $jp = JumlahPekan::where('id','=','1')->first();      
        $tampil = [];
        $guru = Guru::where('id','!=','0')->where('aktif','=',1)->orderBy('nama')->get();
        foreach($guru as $g){
            $juml = Kbm::where('id_guru','=',$g->id)
                         ->whereBetween('kbm.tanggal', [$periode->awal, $periode->akhir])
                         ->count();
            $target = Target::where('id_periode','=',$periode->id)
                        ->where('id_guru','=',$g->id)
                        ->first();
            
            if(is_null($target)){
               $tampil[$g->id] = array('id' => $g->id,
                                    'nama' => $g->nama,
                                    'juml' => $juml,
                                    'target' => 0);
            }else{
                $tampil[$g->id] = array('id' => $g->id,
                                    'nama' => $g->nama,
                                    'juml' => $juml,
                                    'target' => ($target->target * $jp->jumlahPekan));
            }
            
        }
        return view('pages.laporan.guru',compact(['tampil','periode']));
    }

    public function laporanGuruId($id)
    {
                $skrg = Carbon::now()->dayOfWeek;
                $tanggal = Carbon::now()->format('Y-m-d');  
                // dd($tanggal);    
                $kelas = Kelas::all();
                $mapel = Mapel::all();
                $lokasi = Lokasi::all();
                $guru = Guru::all();
                $status = Status::all();
                $sekolah = Sekolah::findOrFail('1');
                $app = DB::table('app')->where('id','=','1')->first();
                
                $periode = Periode::where('aktif','=','1')->first();
            
                $cek = Guru::find($id);
                $kbm = Kbm::where('id_guru','=',$id)
                        ->whereBetween('tanggal', [$periode->awal, $periode->akhir])
                        ->orderBy('tanggal','ASC')   
                        ->get();

                return view('pages.laporan.guruId',compact(['tanggal','skrg','cek','kbm','periode','sekolah','app']));
    }

     public function laporanTendikId($id)
    {
                $skrg = Carbon::now()->dayOfWeek;
                $tanggal = Carbon::now()->format('Y-m-d');
                $awal = Carbon::now()->subMonths(12);     
                $akhir = Carbon::now();    
                $sekolah = Sekolah::findOrFail('1');
                $app = DB::table('app')->where('id','=','1')->first();
                
                $periode = Periode::where('aktif','=','1')->first();
            
                $cek = Tendik::find($id);
                $jurnal = JurnalTendik::where('id_tendik','=',$id)
                        ->whereBetween('jurnaltendik.tanggal', [$awal, $akhir])
                        ->orderBy('jurnaltendik.tanggal','ASC')   
                        ->get();
                
                return view('pages.laporan.tendikId',compact(['tanggal','skrg','cek','jurnal','periode','sekolah','app']));
    }

    public function laporanTendikDetilId($id)
    {
                $skrg = Carbon::now()->dayOfWeek;
                $tanggal = Carbon::now()->format('Y-m-d');
                $awal = Carbon::now()->subMonths(12);     
                $akhir = Carbon::now();    
                $sekolah = Sekolah::findOrFail('1');
                $app = DB::table('app')->where('id','=','1')->first();
                
                $periode = Periode::where('aktif','=','1')->first();
            
                
                $k = JurnalTendik::where('id','=',$id)   
                        ->first();
                $cek = Tendik::find($k->id_tendik);
                return view('pages.laporan.tendikDetilId',compact(['tanggal','skrg','cek','k','periode','sekolah','app']));
    }

    public function laporanPerbulan(){
        // $guru = Guru::where('aktif','=','1')->get();
        $guru = Guru::with('target')->has('target')->get();
        $capaian_ar = array();

        foreach($guru as $guru){
            $capaian = Kbm::where('id_guru', $guru->id)->whereMonth('tanggal',Carbon::now()->month)->count();
            $target = $guru->target->target * 4;
            $persen = $target != 0 ? (number_format($capaian/$target * 100,2)) : 0;
            $capaian_ar[] = array('nama' => $guru->nama,'target' => $target, 'capaian' => $capaian, 'persen' => $persen);
        }

        return view('pages.laporan.perbulan', compact(['capaian_ar']));
    }

    public function laporanPerbulanFilter(Request $request) {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        // $rentang = explode(' - ',$request->rentang);
        // $awal = explode('/',$rentang[0]);
        // $awal = $awal[2].'-'.$awal[1].'-'.$awal[0];

        // $akhir = explode('/',$rentang[1]);
        // $akhir = $akhir[2].'-'.$akhir[1].'-'.$akhir[0];

        // dd($awal,$akhir);

        $jumlah_pekan = $this->datediffInWeeks($startDate, $endDate);

        $guru = Guru::with('target')->has('target')->get();
        $capaian_ar = array();
        $dataArr['data'] = array();

        $no = 1;
        foreach($guru as $guru){
            $capaian = Kbm::where('id_guru', $guru->id)->whereBetween('tanggal', [$startDate, $endDate])->count();
            $target = $guru->target->target * $jumlah_pekan;
            $persen = $target != 0 ? (number_format($capaian/$target * 100,2)) : 0;
            // $capaian_ar[] = array('nama' => $guru->nama,'target' => $target, 'capaian' => $capaian);
            $dataArr['data'][] = array($no++, $guru->nama, $target . ' JP', $capaian . ' JP',  $persen .'%');
        }
        
        
        // foreach($guru as $guru){
        // }

        return response()->json($dataArr);

    }

    private function datediffInWeeks($date1, $date2)
    {
        if($date1 > $date2) return $this->datediffInWeeks($date2, $date1);
        $first = DateTime::createFromFormat('Y-m-d', $date1);
        $second = DateTime::createFromFormat('Y-m-d', $date2);
        return floor($first->diff($second)->days/7 + 1);
    }
}
