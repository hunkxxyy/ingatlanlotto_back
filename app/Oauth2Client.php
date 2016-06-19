<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oauth2Client extends Model
{
   protected $table='oauth_clients';
    protected $fillable=['secret','name'];
}
