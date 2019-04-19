<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    protected $fillable = [
    	'tps_number',
        'tps_name',
        'kelurahan_id',
        'kecamatan_id',
        'kokab_id',
        'province_id',
    ];

    public function transform()
    {
    	$array = [];
    	$tps = Tps::latest()->get();
    	foreach ($tps as $val) {
    		$province_name     = Provinsi::where('id',$val->province_id)->first()->province_name;
    		$kokab_name        = Kokab::where('id',$val->kokab_id)->first()->kokab_name;
    		$kecamatan_name    = Kecamatan::where('id',$val->kecamatan_id)->first()->kecamatan_name;
    		$kelurahan_name    = Kelurahan::where('id',$val->kelurahan_id)->first()->kelurahan_name;
    		array_push($array, [
    			'id'=>$val->id,
    			'tps_number'=>$val->tps_number,
    			'tps_name'=>$val->tps_name,
    			'province_name'=>$province_name,
    			'province_id'=>$val->province_id,
    			'kokab_id'=>$val->kokab_id,
    			'kokab_name'=>$kokab_name,
    			'kecamatan_id'=>$val->kecamatan_id,
    			'kecamatan_name'=>$kecamatan_name,
    			'kelurahan_id'=>$val->kelurahan_id,
    			'kelurahan_name'=>$kelurahan_name,
    		]);
    	}

    	return $array;
    }
}
