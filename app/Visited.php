<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visited extends Model
{
    protected $fillable=['ingatlan_id','user_id'];
}
