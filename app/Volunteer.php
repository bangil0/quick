<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = ['user_id','nip','jk','date_of_birth','address'];
}
