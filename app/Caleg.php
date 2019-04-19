<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TypeCandidates;
use App\Partai;
use App\Provinsi;
class Caleg extends Model
{
    protected $fillable = [
    	'id',
        'name',
        'photo',
        'serial_number',
        'jk',
        'province_id',
        'partai_id',
        'type_candidate_id',
    ];

    public function transform()
    {
    	$array = [];
    	$caleg = Caleg::latest()->get();
    	foreach ($caleg as $val) {
    		$type_candidates = TypeCandidates::where('id',$val->type_candidate_id)->first()->type;
    		$partai          = Partai::where('id',$val->partai_id)->first()->partai_name;
    		$province        = Provinsi::where('id',$val->province_id)->first()->province_name;
    		array_push($array, [
    			'id'=>$val->id,
		        'name'=>$val->name,
		        'photo'=>$val->photo,
		        'serial_number'=>$val->serial_number,
		        'jk'=>$val->jk,
		        'province_id'=>$val->province_id,
		        'partai_id'=>$val->partai_id,
		        'type_candidate_id'=>$val->type_candidate_id,
		        'type'=>$type_candidates,
		        'partai_name'=>$partai,
		        'province_name'=>$province,
    		]);
    	}

    	return $array;
    }

    public function re_transform($caleg)
    {
        $array = [];
        foreach ($caleg as $val) {
            $type_candidates = TypeCandidates::where('id',$val->type_candidate_id)->first()->type;
            $partai          = Partai::where('id',$val->partai_id)->first()->partai_name;
            $province        = Provinsi::where('id',$val->province_id)->first()->province_name;
            array_push($array, [
                'id'=>$val->id,
                'name'=>$val->name,
                'photo'=>$val->photo,
                'serial_number'=>$val->serial_number,
                'jk'=>$val->jk,
                'province_id'=>$val->province_id,
                'partai_id'=>$val->partai_id,
                'type_candidate_id'=>$val->type_candidate_id,
                'type'=>$type_candidates,
                'partai_name'=>$partai,
                'province_name'=>$province,
            ]);
        }

        return $array;
    }

    public function single_transform($caleg)
    {
        $data = Caleg::where('id',$caleg->caleg_id)->first();
        $type_candidates = TypeCandidates::where('id',$data->type_candidate_id)->first()->type;
        $partai          = Partai::where('id',$data->partai_id)->first()->partai_name;
        $province        = Provinsi::where('id',$data->province_id)->first()->province_name;

        $array = [
            'id'=>$data->id,
            'name'=>$data->name,
            'photo'=>$data->photo,
            'serial_number'=>$data->serial_number,
            'jk'=>$data->jk,
            'province_id'=>$data->province_id,
            'partai_id'=>$data->partai_id,
            'type_candidate_id'=>$data->type_candidate_id,
            'type'=>$type_candidates,
            'partai_name'=>$partai,
            'province_name'=>$province,
        ];

        return $array;
    }

    public function own_transform($caleg)
    {
        $data = Caleg::where('id',$caleg->id)->first();
        $type_candidates = TypeCandidates::where('id',$data->type_candidate_id)->first()->type;
        $partai          = Partai::where('id',$data->partai_id)->first()->partai_name;
        $province        = Provinsi::where('id',$data->province_id)->first()->province_name;

        $array = [
            'id'=>$data->id,
            'name'=>$data->name,
            'photo'=>$data->photo,
            'serial_number'=>$data->serial_number,
            'jk'=>$data->jk,
            'province_id'=>$data->province_id,
            'partai_id'=>$data->partai_id,
            'type_candidate_id'=>$data->type_candidate_id,
            'type'=>$type_candidates,
            'partai_name'=>$partai,
            'province_name'=>$province,
        ];

        return $array;
    }
}
