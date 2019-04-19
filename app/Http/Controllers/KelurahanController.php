<?php

namespace App\Http\Controllers;

use App\Kelurahan;
use App\Provinsi;
use App\Kecamatan;
use App\Kokab;

use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    private $kecamatan;
    private $kelurahan;
    public function __construct()
    {
        $this->kecamatan = new Kecamatan();
        $this->kelurahan = new Kelurahan();
    }
    
    public function index()
    {
        $data = $this->kelurahan->kelurahan_transform();
        $province = Provinsi::latest()->get();
        return view('region.kelurahan.index',compact('data','province'));
    }

    public function validate_form($request)
    {
        $this->validate($request,[
            'province_id'=>'required',
            'kokab_id'=>'required',
            'kecamatan_id'=>'required',
            'kelurahan_name'=>'required'
        ]);
    }

    public function store(Request $request)
    {
        self::validate_form($request);
        Kelurahan::create($request->all());
        return back()->withMessage('Berhasil membuat Kelurahan');
    }

    public function update(Request $request, $id)
    {
        self::validate_form($request);
        Kelurahan::findOrFail($id)->update($request->except('_token','_method'));
        return back()->withMessage('Berhasil mengubah Kelurahan');
    }

    public function destroy($id)
    {
        Kelurahan::destroy($id);
        return back()->withMessage('Berhasil Menghapus Kelurahan');
    }

    public function kecamatan($kokab_id)
    {
        return Kecamatan::where('kokab_id',$kokab_id)->get();
    }
}
