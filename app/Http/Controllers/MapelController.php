<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mapel::orderBy('nama')->get();
        return view('pages.mapel.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mapel = Mapel::create([
            'nama' => $request->nama,
            'singkatan' => $request->singkatan
        ]);

        return redirect('/mapel');
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
        $data = Mapel::findOrFail($id);
        return view('pages.mapel.edit',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Mapel::findOrFail($request->id);
        $data->nama = $request->nama;
        $data->singkatan = $request->singkatan;
        $data->save();

        return redirect('/mapel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
