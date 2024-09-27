<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Lokasi::where('id','>','0')->orderBy('id')->get();
        return view('pages.lokasi.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Lokasi::orderBy('id','DESC')->first();
        Lokasi::create([
            'id' => $id->id + 1,
            'nama_lokasi' => $request->nama_lokasi,
        ]);

        return redirect('/lokasi');
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
        $data = Lokasi::findOrFail($id);
        return view('pages.lokasi.edit',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Lokasi::findOrFail($request->id);
        $data->nama_lokasi = $request->nama;
        $data->save();
        return redirect('/lokasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
