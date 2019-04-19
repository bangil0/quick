<?php

namespace App\Http\Controllers;

use App\CandidatesPemilu;
use App\Caleg;
use App\TypeCandidates;
use App\PemiluSetting;
use App\Transaction;
use Illuminate\Http\Request;

class CandidatesPemiluController extends Controller
{
    private $caleg;

    public function __construct()
    {
        $this->caleg = new Caleg();
    }

    public function index($pemilu_setting_id)
    {
        $setting = PemiluSetting::where('id',$pemilu_setting_id)->first();
        $type    = TypeCandidates::where('id',$setting->type_candidates_id)->first();
        if ($type->type == "DPR RI") {
            $caleg = $this->caleg->re_transform(Caleg::latest()->get());
        }elseif ($type->type == "DPD RI") {
            $caleg = $this->caleg->re_transform(Caleg::where('province_id',$setting->province_id)->latest()->get());
        }
        if ($type->type == "DPRD PROVINSI") {
            $caleg = $this->caleg->re_transform(Caleg::where('province_id',$setting->province_id)->latest()->get());
        }

        $new_caleg = [];
        foreach ($caleg as $data) {
            $cek = CandidatesPemilu::where('caleg_id',$data['id'])->where('pemilu_setting_id',$pemilu_setting_id)->count();
            if ($cek > 0) {
                $data['terpilih'] = "terpilih";
            }else{
                $data['terpilih'] = "belum";
            }

            $new_caleg[] = $data;
        }


        return view('pemilu.caleg.index',compact('new_caleg','pemilu_setting_id'));
    }
    
    public function store(Request $request)
    {
        Transaction::where('pemilu_setting_id',$request->pemilu_setting_id)->where('caleg_id',$request->caleg_id)->delete();
        $check = CandidatesPemilu::where('caleg_id',$request->caleg_id)->where('pemilu_setting_id',$request->pemilu_setting_id);
        if ($check->count() > 0) {
            $check->delete();
        }else{
            CandidatesPemilu::create($request->all());
        }

        return response()->json(['status'=>'success','code'=>'200']);
    }

}
