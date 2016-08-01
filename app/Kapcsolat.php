<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kapcsolat extends Model
{
    protected $table='kapcsolat';
    protected $fillable=['tartalom','cim'];
}
