<?php

namespace App\Http\Controllers;

use App\Szintek;
use Illuminate\Http\Request;

use App\Http\Requests;

class SzintekController extends Controller
{
    public function index(){
        return Szintek::all();
    }
    public function menu(){
        $szintek=new Szintek();
        return $szintek->getMenu();
    }
    public function tartalom($szint_id){
        $szintek=new Szintek();
        return $szintek->getTartalom($szint_id);

    }
}
