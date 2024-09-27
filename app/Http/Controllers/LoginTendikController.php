<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginTendikController extends Controller
{
    public function login()
    {
        $sekolah = DB::table('sekolah')->where('id','=','1')->first();
        $app = DB::table('app')->where('id','=','1')->first();
        return view('pages.jurnalTendik.login',compact(['sekolah','app']));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('id_tendik');
        return redirect('/tendik');
    }

    public function cekLogin(Request $request)
    {
        $cek = DB::table('tendik')
                ->where('id','=',$request->id)
                ->where('password','=',$request->password)
                ->first();
        
        if($cek == null){
            return redirect('/jurnal/tendik/login')->with('status', 'Username/Password Salah!');
        }else{
            $request->session()->put('id_tendik',$cek->id);
            return redirect('/jurnal/tendik');
        }
    }
}