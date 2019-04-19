<?php

namespace App\Http\Controllers;

use App\Caleg;
use App\Partai;
use App\TypeCandidates;
use App\Provinsi;
use Illuminate\Http\Request;

class CalegController extends Controller
{
    private $caleg;
    
    public function __construct()
    {
        $this->caleg = new Caleg();
    }


    public function index()
    {
        $data     = $this->caleg->transform();
        $partai   = Partai::latest()->get();
        $type     = TypeCandidates::latest()->get();
        $province = Provinsi::latest()->get();
        return view('caleg.index',compact('data','partai','type','province'));
    }

    public function validate_form($request)
    {
        $this->validate($request,[
            'name'=>'required',
            'photo'=>'required',
            'serial_number'=>'required',
            'jk'=>'required',
            'province_id'=>'required',
            'partai_id'=>'required',
            'type_candidate_id'=>'required',
        ]);
    }

    public function store(Request $request)
    {
        self::validate_form($request);
        $caleg = new Caleg();
        $caleg->fill($request->all());
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $name  = uniqid().".".$photo->getClientOriginalExtension();
            $photo->move(public_path('images/caleg'),$name);

            $caleg->photo = $name;
            $caleg->save();
            return back()->withMessage('Berhasil Membuat Caleg');
        }
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        $this->validate($request,[
            'name'=>'required',
            'serial_number'=>'required',
            'jk'=>'required',
            'province_id'=>'required',
            'partai_id'=>'required',
            'type_candidate_id'=>'required',
        ]);

        $caleg = Caleg::where('id',$id);
        

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $name  = uniqid().".".$photo->getClientOriginalExtension();
            $photo->move(public_path('images/caleg'),$name);

            unlink(public_path('images/caleg/'.$caleg->first()->photo));

            $caleg->update([
                'name'=>$request->name,
                'serial_number'=>$request->serial_number,
                'jk'=>$request->jk,
                'province_id'=>$request->province_id,
                'partai_id'=>$request->partai_id,
                'type_candidate_id'=>$request->type_candidate_id,
                'photo'=>$name,
            ]);

        }else{
            $caleg->update([
                'name'=>$request->name,
                'serial_number'=>$request->serial_number,
                'jk'=>$request->jk,
                'province_id'=>$request->province_id,
                'partai_id'=>$request->partai_id,
                'type_candidate_id'=>$request->type_candidate_id,
            ]);
        }

        
        return back()->withMessage('Berhasil Mengubah Caleg');

    }

    public function destroy($id)
    {
        $caleg = Caleg::where('id',$id);
        unlink(public_path('images/caleg/'.$caleg->first()->photo));
        $caleg->delete();
        return back()->withMessage('Berhasil Menghapus Caleg');
    }
}
