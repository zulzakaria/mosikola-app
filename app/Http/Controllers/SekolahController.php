<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\Config;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sp = Sekolah::findOrFail('1');
        // dd($sp);
        return view('pages.sekolah.index',compact(['sp']));
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
        //
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
    public function update(Request $request)
    {
        $sp = Sekolah::findOrFail($request->id);
        $sp->npsn = $request->npsn;
        $sp->nama = $request->nama;
        $sp->kepsek = $request->kepsek;
        $sp->alamat = $request->alamat;
        $sp->email = $request->email;
        $sp->phone = $request->phone;
        $sp->appName = $request->appName;
        $sp->appNameShort = $request->appNameShort;
        $sp->save();

        return redirect('/sekolah')->with('success','Berhasil update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function kontrol()
    {
        $kontrol = Config::findOrFail('1');
        return view('pages.kontrol.index',compact(['kontrol']));
    }

    public function updateKontrol(Request $request)
    {
        $sp = Config::findOrFail($request->id);
        $sp->lampau = $request->lampau;
        $sp->save();

        return redirect('/kontrol')->with('success','Berhasil update.');
    }
}
