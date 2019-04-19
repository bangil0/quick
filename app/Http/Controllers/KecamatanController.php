<?php

namespace App\Http\Controllers;

use App\Kecamatan;
use App\Provinsi;
use App\Kokab;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    private $kecamatan;

    public function __construct()
    {
        $this->kecamatan = new Kecamatan();
    }
    
    public function index()
    {
        $data = $this->kecamatan->kecamatan_transform();
        $province = Provinsi::latest()->get();
        return view('region.kecamatan.index',compact('data','province'));
    }
    
    public function validate_form($request){
        $this->validate($request,[
            'province_id'=>'required',
            'kokab_id'=>'required',
            'kecamatan_name'=>'required',
        ]);
    }

    public function store(Request $request)
    {
        self::validate_form($request);
        Kecamatan::create($request->all());
        return back()->withMessage('Berhasil Menambahkan Kecamatan');
    }

    public function update(Request $request,$id)
    {
        self::validate_form($request);
        Kecamatan::findOrFail($id)->update($request->except('_token','_method'));
        return back()->withMessage('Berhasil Mengubah Kecamatan');
    }

    public function destroy($id)
    {
        Kecamatan::destroy($id);
        return back()->withMessage('Berhasil Menghapus Kecamatan');
    }

    public function kokab($province_id)
    {
        return Kokab::where('province_id',$province_id)->get();
    }
}
