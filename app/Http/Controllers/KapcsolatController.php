<?php

namespace App\Http\Controllers;

use App\Kapcsolat;
use Illuminate\Http\Request;

use App\Http\Requests;

class KapcsolatController extends Controller
{
    public function setParams(Request $request)
    {
        $values = $request->all();
        $kapcsolat = Kapcsolat::find(1);
        if (!$kapcsolat) Kapcsolat::create($values);
        else {
            $kapcsolat->fill($request->all());
            $kapcsolat->push();
        }
        return response()->json($kapcsolat);
    }

    public function getParams()
    {


        $kapcsolat = Kapcsolat::find(1);
        if (!$kapcsolat) return response()->json(
            [
                'id' => '1',
                'tartalom' => '',
                'cim'=>''
            ]) ;
        else
            return response()->json($kapcsolat);

    }
}
