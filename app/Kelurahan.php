<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kecamatan;
use App\Provinsi;
use App\Kokab;
class Kelurahan extends Model
{
    protected $fillable = ['province_id','kokab_id','kecamatan_id','kelurahan_name'];

    public function kelurahan_transform()
    {
    	$array = [];
    	$kelurahan = Kelurahan::latest()->get();
    	foreach ($kelurahan as $val) {
    		$province_name = Provinsi::where('id',$val->province_id)->first()->province_name;
    		$kokab_name    = Kokab::where('id',$val->kokab_id)->first();
    		$kecamatan_name    = Kecamatan::where('id',$val->kecamatan_id)->first()->kecamatan_name;
    		array_push($array, [
    			'id'=>$val->id,
    			'province_name'=>$province_name,
    			'province_id'=>$val->province_id,
    			'kokab_id'=>$val->kokab_id,
    			'kokab_name'=>$kokab_name['kokab_name'],
    			'kecamatan_id'=>$val->kecamatan_id,
    			'kecamatan_name'=>$kecamatan_name,
    			'kelurahan_name'=>$val->kelurahan_name,
    		]);
    	}

    	return $array;
    }
}
