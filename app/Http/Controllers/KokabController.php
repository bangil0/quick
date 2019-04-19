<?php

namespace App\Http\Controllers;

use App\Kokab;
use App\Provinsi;
use Illuminate\Http\Request;

class KokabController extends Controller
{
    
    private $kokab;
    public function __construct()
    {
        $this->kokab = new Kokab();
    }

    public function index()
    {
        $data = $this->kokab->kokab_transform();
        $province = Provinsi::latest()->get();
        return view('region.kokab.index',compact('data','province'));
    }
    
    public function validate_form($request)
    {
        $this->validate($request,[
            'province_id'=>'required',
            'kokab_name'=>'required',
        ]);
    }

    public function store(Request $request)
    {
        self::validate_form($request);
        Kokab::create($request->all());
        return back()->withMessage('Berhasil Menambahkan Kokab');
    }

    public function update(Request $request, $id)
    {
        self::validate_form($request);
        Kokab::findOrFail($id)->update($request->except('_token','_method'));
        return back()->withMessage('Berhasil Mengubah Kokab');
    }

    public function destroy($id)
    {
        Kokab::destroy($id);
        return back()->withMessage('Berhasil Menghapus Kokab');
    }
}
