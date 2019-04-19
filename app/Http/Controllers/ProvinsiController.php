<?php

namespace App\Http\Controllers;

use App\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function index()
    {
        $data = Provinsi::latest()->get();
        return view('region.province.index',compact('data'));
    }

    public function validate_form($request)
    {
        $this->validate($request,[
            'province_name'=>'required',
        ]);
    }

    public function store(Request $request)
    {
        self::validate_form($request);
        Provinsi::create($request->all());

        return back()->withMessage('Berhasil Menambahkan Provinsi');
    }

    public function update(Request $request, $id)
    {
        self::validate_form($request);
        Provinsi::findOrFail($id)->update($request->except('_token','_method'));
        return back()->withMessage('Berhasil Mengubah Provinsi');
    }

    public function destroy($id)
    {
        Provinsi::destroy($id);
        return back()->withMessage('success');
    }
}
