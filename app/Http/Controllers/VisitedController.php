<?php

namespace App\Http\Controllers;

use App\Visited;
use Illuminate\Http\Request;

use App\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class VisitedController extends Controller
{
    public function __construct()
    {

       // $this->middleware('oauth');
    }
    public function show()
    {
        return 'nem megy';
    }

    public function store(Request $request)
    {
//        $values = $request->all();
        /*file_put_contents('hunk2.log', Authorizer::getResourceOwnerId());*/
/*        $v=new Visited();
        $values['user_id']=Authorizer::getResourceOwnerId();
        $ch=$v->where('user_id', $values['user_id'])->where('ingatlan_id',$values['ingatlan_id'])->count();

        if (!$ch)
        {
            $visited= Visited::create($values);
            return response()->json(['msg' => 'oké', 'Ingatlan' => $visited], 202);
        }
        else  return response()->json(['msg' => 'Létezik már']);*/


    }
}
