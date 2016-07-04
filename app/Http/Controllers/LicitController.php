<?php

namespace App\Http\Controllers;



use App\Ingatlan;
use App\Licit;
use App\utils\QueryBuilder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateLicitRequest;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Support\Facades\DB;

class LicitController extends Controller
{

    public function __construct()
    {

        $this->middleware('oauth');
    }
    public function store(Request $request){

        $ingatlan=Ingatlan::find($request['ingatlan_id']);

        $userId=Authorizer::getResourceOwnerId();
        $values = $request->all();
        $values['user_id']=$userId;
        $kibocsajtott_sorsjegyek=ceil($ingatlan->ingatlan_ar/$ingatlan->sorsjegy_ar);
        $megvasarolt_sorsjegyek=DB::table('licits')->where('ingatlan_id',$ingatlan->id)->count();
        $megvasarolt_sorsjegyek++;
        $ingatlan->szazalek_ertekesitve=ceil(($megvasarolt_sorsjegyek/$kibocsajtott_sorsjegyek)*100);
        $ingatlan->save();
        //file_put_contents('hunk2.log', print_r($values, true),FILE_APPEND );
       Licit::create($values);

        return response()->json(['msg'=>'sikeres szavazás','return'=>$ingatlan->szazalek_ertekesitve]);
    }

}
