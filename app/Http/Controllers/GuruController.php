<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use Image;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Guru::orderBy('aktif','DESC')->orderBy('nama')->get();
        return view('pages.guru.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('pages.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $guru = Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'password' => '12345'
        ]);
 
        return redirect('/guru');
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

    public function nonAktifkan(Request $request)
    {
        $guru = Guru::findOrFail($request->id);
        $guru->aktif = 0;
        $guru->save();
        return redirect('/guru');
    }

    public function aktifkan(Request $request)
    {
        $guru = Guru::findOrFail($request->id);
        $guru->aktif = 1;
        $guru->save();
        return redirect('/guru');
    }

    public function resetPassword(Request $request)
    {
        $guru = Guru::findOrFail($request->id);
        $guru->password = '12345';
        $guru->save();
        return redirect('/guru');
    }

    public function profil(Request $request)
    {
        $id = $request->session()->get('id_guru');
        if($id == null){
            return redirect('/login');
        }
        $guru = Guru::find($id);
        return view('pages.guru.profil',compact(['guru']));
    }

    public function profilUpdate(Request $request)
    {
        $guru = Guru::find($request->id);

        $guru->nama = $request->nama;
        $guru->nip = $request->nip;

        if($request->password != ""){
            $guru->password = $request->password;
        }
        

        if($request->hasFile('foto')) {
            $originalImage= $request->file('foto');
            $image = Image::make($originalImage);
            $path = public_path().'/ptk/';
            // $image->resize(800,600, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            $image->save($request->id.".".$originalImage->getClientOriginalExtension()); 
            $nm_file = $request->id.".".$originalImage->getClientOriginalExtension();
            $request->foto->move(public_path('ptk'), $nm_file);
            $guru->foto = $nm_file;
        }

        
        $guru->save();

        return redirect('/guru/profil')->with('sukses','Berhasil Disimpan');
    }
}
