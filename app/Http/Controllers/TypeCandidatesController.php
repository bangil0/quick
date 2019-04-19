<?php

namespace App\Http\Controllers;

use App\TypeCandidates;
use Illuminate\Http\Request;

class TypeCandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TypeCandidates::latest()->get();
        return view('caleg.type.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function validate_form($request)
    {
        $this->validate($request,[
            'type'=>'required',
        ]);
    }
    public function store(Request $request)
    {
        self::validate_form($request);
        TypeCandidates::create($request->all());
        return back()->withMessage('Berhasil Membuat Tipe Caleg');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeCandidates  $typeCandidates
     * @return \Illuminate\Http\Response
     */
    public function show(TypeCandidates $typeCandidates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeCandidates  $typeCandidates
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeCandidates $typeCandidates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeCandidates  $typeCandidates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        self::validate_form($request);
        TypeCandidates::findOrFail($id)->update($request->except('_token','_method'));
        return back()->withMessage("Berhasil Mengubah Tipe");
    }

    public function destroy($id)
    {
        TypeCandidates::destroy($id);
        return back()->withMessage("Berhasil Menghapus Tipe");
    }
}
