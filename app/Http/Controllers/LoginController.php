<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login()
    {
        $sekolah = DB::table('sekolah')->where('id','=','1')->first();
        $app = DB::table('app')->where('id','=','1')->first();
        return view('pages.jurnal.login',compact(['sekolah','app']));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('id_guru');
        return redirect('/');
    }

    public function cekLogin(Request $request)
    {
        $cek = DB::table('guru')
                ->where('id','=',$request->id)
                ->where('password','=',$request->password)
                ->first();
        
        if($cek == null){
            return redirect('/jurnal/login')->with('status', 'Username/Password Salah!');
        }else{
            $request->session()->put('id_guru',$cek->id);
            return redirect('/jurnal');
        }
    }
}