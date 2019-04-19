<?php

namespace App\Http\Controllers;

use App\Partai;
use Illuminate\Http\Request;

class PartaiController extends Controller
{
    private $partai;

    public function __construct()
    {
        $this->partai = new Partai();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Partai::latest()->get();
        return view('partai.index',compact('data'));
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
            'photo'=>'required',
            'partai_name'=>'required',
        ]);
    }

    public function store(Request $request)
    {
        self::validate_form($request);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $name  = uniqid().".".$photo->getClientOriginalExtension();
            $photo->move(public_path('images/partai/'),$name);

            $this->partai->partai_name = $request->partai_name;
            $this->partai->photo       = $name;
            $this->partai->save();

            return back()->withMessage('Berhasil Membuat Partai');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function show(Partai $partai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function edit(Partai $partai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'partai_name'=>'required',
        ]);
        // return $request->all();
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $name  = uniqid().".".$photo->getClientOriginalExtension();
            $photo->move(public_path('images/partai/'),$name);

            $partai = Partai::where('id',$id)->update([
                'partai_name'=>$request->partai_name,
                'photo'=>$name,
            ]);

        }else{
            $partai = Partai::findOrFail($id);
            $partai->partai_name = $request->partai_name;
            $partai->save();
        }

        return back()->withMessage('Berhasil Mengubah Partai');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partai = Partai::findOrFail($id);
        unlink(public_path('images/partai/'.$partai->first()->photo));
        $partai->delete();
        return back()->withMessage('Berhasil Menghapus Partai');
    }
}
