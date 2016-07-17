<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eredmenyek extends Model
{
    protected $table='eredmenyek';
    protected $fillable=['title','content','datum','archived'];
    public function archive()
    {
        $this->archived = 1;

        $this->save();
    }
}
