<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tendik;
use Image;

class TendikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tendik::orderBy('aktif','DESC')->orderBy('nama')->get();
        return view('pages.tendik.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('pages.tendik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tendik = Tendik::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'password' => '54321'
        ]);
 
        return redirect('/tendik/index');
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
        $tendik = Tendik::findOrFail($request->id);
        $tendik->aktif = 0;
        $tendik->save();
        return redirect('/tendik/index');
    }

    public function aktifkan(Request $request)
    {
        $tendik = Tendik::findOrFail($request->id);
        $tendik->aktif = 1;
        $tendik->save();
        return redirect('/tendik/index');
    }

    public function resetPassword(Request $request)
    {
        $tendik = Tendik::findOrFail($request->id);
        $tendik->password = '54321';
        $tendik->save();
        return redirect('/tendik/index');
    }

    public function profil(Request $request)
    {
        $id = $request->session()->get('id_tendik');
        if($id == null){
            return redirect('/login');
        }
        $tendik = Tendik::find($id);
        return view('pages.tendik.profil',compact(['tendik']));
    }

    public function profilUpdate(Request $request)
    {
        $tendik = Tendik::find($request->id);

        $tendik->nama = $request->nama;
        $tendik->nip = $request->nip;

        if($request->password != ""){
            $tendik->password = $request->password;
        }
        

        if($request->hasFile('foto')) {
            $originalImage= $request->file('foto');
            $image = Image::make($originalImage);
            $path = public_path().'/tendik_img/';
            // $image->resize(800,600, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            $image->save($request->id.".".$originalImage->getClientOriginalExtension()); 
            $nm_file = $request->id.".".$originalImage->getClientOriginalExtension();
            $request->foto->move(public_path('tendik_img'), $nm_file);
            $tendik->foto = $nm_file;
        }

        
        $tendik->save();

        return redirect('/tendik/profil')->with('sukses','Berhasil Disimpan');
    }
}
