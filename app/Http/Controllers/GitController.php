<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class GitController extends Controller
{

    public function pull(){
        $cmd="git pull origin master";
        //hunk
        system($cmd);
        print 'Áthúzva sikeresen';
    }
}
