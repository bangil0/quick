<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    	'voluteer_id',
        'caleg_id',
        'pemilu_setting_id',
        'tps_id',
        'number_of_votes',
    ];
}
