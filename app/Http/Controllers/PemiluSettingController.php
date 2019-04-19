<?php

namespace App\Http\Controllers;

use App\PemiluSetting;
use App\TypeCandidates;
use App\CandidatesPemilu;
use App\Provinsi;
use App\Transaction;
use Illuminate\Http\Request;

class PemiluSettingController extends Controller
{
    
    public function index()
    {
        $array = [];
        $pemilu = PemiluSetting::all();
        foreach ($pemilu as $val) {
            $typeCandidates = TypeCandidates::where('id',$val->type_candidates_id)->first()->type;
            array_push($array, [
                'id'=>$val->id,
                'type_candidates_id'=>$val->type_candidates_id,
                'pemilu_name'=>$val->pemilu_name,
                'type'=>$typeCandidates,
            ]);
        }

        $data = TypeCandidates::all();
        $province = Provinsi::latest()->get();
        return view('pemilu.setting.index',compact('array','data','province'));
    }

    public function validate_form($request)
    {
        $this->validate($request,[
            'pemilu_name'=>'required',
            'type_candidates_id'=>'required',
        ]);
    }

    public function store(Request $request)
    {
        self::validate_form($request);
        PemiluSetting::create($request->all());

        return back()->withMessage("Berhasil Menambahkan Pemilu");
    }
    
    public function update(Request $request, $id)
    {
        self::validate_form($request);
        PemiluSetting::findOrFail($id)->update($request->except('_token','_method'));
        return back()->withMessage("Berhasil Mengubah Pemilu");
    }

    
    public function destroy($id)
    {
        CandidatesPemilu::where('pemilu_setting_id',$id)->delete();
        Transaction::where('pemilu_setting_id',$id)->delete();
        PemiluSetting::destroy($id);
        return back()->withMessage("Berhasil Menghapus Pemilu");
    }

    public function getCaleg($id)
    {
        $data = CandidatesPemilu::where('pemilu_setting_id',$id)->first();
    }
}
