<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Provinsi;
class Kokab extends Model
{
    protected $fillable = ['province_id','kokab_name'];

    public function kokab_transform()
    {
    	$array = [];
    	$data = Kokab::latest()->get();
    	foreach ($data as $field) {
    		$province_name = Provinsi::where('id',$field->province_id)->first()->province_name;
    		array_push($array, [
    			'id'=>$field->id,
    			'province_id'=>$field->province_id,
    			'province_name'=>$province_name,
    			'kokab_name'=>$field->kokab_name,
    		]);
    	}

    	return $array;
    }

}
