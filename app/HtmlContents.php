<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HtmlContents extends Model
{
    protected $table='html_cotents';
    protected $fillable=['tartalom'];
    protected $hidden=['created_at','updated_at'];
}
