<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Periode::all();
        return view('pages.periode.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->akhir > $request->awal){
            Periode::create([
            'nama' => $request->nama,
            'awal' => $request->awal,
            'akhir' => $request->akhir,
            'aktif' => 0
            ]);
            
            return redirect('/periode');
        }else{
            return back()->withInput()->with('status', 'Gagal! Tanggal Awal melebihi Tanggal Akhir.');
        }
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
        $data = Periode::findOrFail($id);
        return view('pages.periode.edit',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if($request->akhir > $request->awal){
            $data = Periode::findOrFail($request->id);
            $data->nama = $request->nama;
            $data->awal = $request->awal;
            $data->akhir = $request->akhir;
            $data->save();

            return redirect('/periode');
        }else{
            return back()->withInput()->with('status', 'Gagal! Tanggal Awal melebihi Tanggal Akhir.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Periode::findOrFail($request->id);
        $data->delete();
        return redirect('/periode');
    }

    public function aktifkan(Request $request)
    {
        $reset = DB::table('periode')->update(['aktif' => 0]);
        
        $data = Periode::findOrFail($request->id);
        $data->aktif = 1;
        $data->save();

        return redirect('/periode');
    }
}
