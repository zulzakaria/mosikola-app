<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Target;
use App\Models\JumlahPekan;
use App\Models\Periode;
use App\Models\Guru;

class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periode = Periode::where('aktif','=','1')->first();
        $guru = Guru::where('aktif','=','1')->orderBy('nama')->get();
        $jp = JumlahPekan::where('id','=',1)->first();
        $data = [];
        foreach($guru as $index => $item){
            $target = Target::where('id_periode','=',$periode->id)
                        ->where('id_guru','=',$item->id)
                        ->first();
            if(is_null($target)){
                $generate = Target::create([
                    'id_guru' => $item->id,
                    'target' => 0,
                    'id_periode' => $periode->id
                ]);
            }

            $target = Target::where('id_periode','=',$periode->id)
                        ->where('id_guru','=',$item->id)
                        ->first();
            $data[$item->id] = array(
                    'id_guru' => $target->id_guru,
                    'nama' => $item->nama,
                    'target' => $target->target,
                    'id' => $target->id);
        }
        return view('pages.target.index', compact(['data','periode','jp']));
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
       $periode = Periode::where('aktif','=','1')->first();
       $target = Target::where('id_periode','=',$periode->aktif)->first();
       
       foreach ($request->input as $index => $item){
            $data = Target::findOrFail($index);
            $data->target = $item;
            $data->save();
       }

       return redirect()->back();
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
    public function destroy(string $id)
    {
        //
    }

    public function jumlahPekan(Request $request)
    {
        $jp = JumlahPekan::where('id','=',1)->first();
        $jp->jumlahPekan = $request->jp;
        $jp->save();

        return redirect()->back();
    }
}
