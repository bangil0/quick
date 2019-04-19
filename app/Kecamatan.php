<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Provinsi;
use App\Kokab;

class Kecamatan extends Model
{
    protected $fillable = ['kokab_id','province_id','kecamatan_name'];

    public function kecamatan_transform()
    {
    	$array = [];
    	$kecamatan = Kecamatan::latest()->get();
    	foreach ($kecamatan as $val) {
    		$province_name = Provinsi::where('id',$val->province_id)->first()->province_name;
    		$kokab_name    = Kokab::where('id',$val->kokab_id)->first();
    		array_push($array, [
    			'id'=>$val->id,
    			'kecamatan_name'=>$val->kecamatan_name,
    			'province_id'=>$val->province_id,
    			'kokab_id'=>$val->kokab_id,
    			'kokab_name'=>$kokab_name['kokab_name'],
    			'province_name'=>$province_name,
    		]);
    	}

    	return $array;
    }
}
