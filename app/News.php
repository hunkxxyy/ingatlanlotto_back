<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table='news';
    protected $fillable=['title','content','datum','archived'];
    public function archive()
    {
        $this->archived = 1;

        $this->save();
    }
}
