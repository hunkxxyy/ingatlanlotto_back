<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class GitController extends Controller
{
    public function clone(){
        $cmd="git clone https://github.com/hunkxxyy/ingatlanlotto_back.git";
        system($cmd);
    }
    public function pull(){
        $cmd="git pull origin master";
        //hunk
        system($cmd);
    }
}
