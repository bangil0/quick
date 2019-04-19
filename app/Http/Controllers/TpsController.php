<?php

namespace App\Http\Controllers;

use App\Tps;
use App\Kecamatan;
use App\Kelurahan;
use App\Provinsi;
use App\PemiluSetting;
use App\TypeCandidates;
use Illuminate\Http\Request;

class TpsController extends Controller
{
    private $kecamatan;
    private $kelurahan;
    private $tps;

    public function __construct()
    {
        $this->kecamatan = new Kecamatan();
        $this->kelurahan = new Kelurahan();
        $this->tps       = new Tps();
    }

    public function index()
    {
        $data = $this->tps->transform();
        $province = Provinsi::latest()->get();
        return view('tps.index',compact('data','province'));
    }

    public function validate_form($request)
    {
        $this->validate($request,[
            'tps_number'=>'required',
            'tps_name'=>'required',
            'kelurahan_id'=>'required',
            'kecamatan_id'=>'required',
            'kokab_id'=>'required',
            'province_id'=>'required',
        ]);
    }

    public function store(Request $request)
    {
        self::validate_form($request);
        Tps::create($request->all());
        return back()->withMessage('Berhasil Membuat TPS');
    }


    public function update(Request $request, $id)
    {
        self::validate_form($request);
        Tps::findOrFail($id)->update($request->except('_token','_method'));
        return back()->withMessage('Berhasil Mengubah TPS');
    }

    public function destroy($id)
    {
        Tps::destroy($id);
        return back()->withMessage('Berhasil Menghapus TPS');
    }

    public function kelurahan_by_kecamatan($kecamatan_id)
    {
        $data = Kelurahan::where('kecamatan_id',$kecamatan_id)->latest()->get();
        return response()->json($data,200);
    }

    public function kelurahan($kelurahan_id)
    {
        $data = Tps::where('kelurahan_id',$kelurahan_id)->get();
        return response()->json($data,200);
    }

    public function pemilu($type,$prov_id,$kokab_id)
    {
        $tipe = TypeCandidates::where('id',$type)->first()->type;
        if ($tipe == "DPR RI") {
            $pemilu = PemiluSetting::where('type_candidates_id',"1")->get();
        }else if ($tipe == "DPD RI") {
            $pemilu = PemiluSetting::where('province_id',$prov_id)->get();
        }else if ($tipe == "DPRD PROVINSI") {
            $pemilu = PemiluSetting::where('province_id',$prov_id)->where('kokab_id',$kokab_id)->get();
        }
        return response()->json($pemilu,200);
    }
}
