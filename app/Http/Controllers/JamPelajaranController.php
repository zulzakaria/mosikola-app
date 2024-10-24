<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jp;
use Illuminate\Support\Facades\DB;

class JamPelajaranController extends Controller
{
    public function index(){
        $hari = Jp::select('hari')->distinct()->get();
        $jp = Jp::all();
        $arr_jp = array();
        foreach($jp as $jp){
            $arr_jp[$jp->hari] = array();

            $hari = Jp::where('hari', $jp->hari)->get();
            foreach($hari as $hari){
                array_push($arr_jp[$jp->hari], array('id' => $hari->id, 'jam_ke' => $hari->jam, 'status' => $hari->is_on));
            }
        }

        // $arr_jp2 = $arr_jp1;
        // $jam = Jp::distinc;

        return view('pages.jam.index', compact('arr_jp'));
    }

    public function gantiStatus(Request $request) {
        $jp = Jp::find($request->id_jp);
        // dd($request->status);
        $jp->is_on = $request->status;
        $jp->save();

        return response()->json(['message' => 'ok']);
    }
}
