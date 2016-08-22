<?php

namespace App\Http\Controllers;

use App\Ingatlan;
use App\IngatlanKepek;
use App\utils\QueryBuilder;
use Illuminate\Http\Request;
USE App\Http\Requests\CreateIngatlanRequest;
use Illuminate\Support\Facades\DB;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class IngatlanController extends Controller
{

    public function __construct()
    {

       $this->middleware('oauth',['except'=>['show','listWithFilters']]);
    }
    public function show($id)
    {
        $kepek=new IngatlanKepek();
        $ingatlan = Ingatlan::find($id);
        $ingatlan->kibocsajtott_sorsjegyek=ceil($ingatlan->ingatlan_ar/$ingatlan->sorsjegy_ar);
        $extra=($ingatlan->ingatlan_ar/$ingatlan->sorsjegy_ar)*($ingatlan->extra_szazalek/100);
        $ingatlan->megvasarolt_sorsjegyek=DB::table('licits')->where('ingatlan_id',$ingatlan->id)->count()+ceil($extra);
        $ingatlan->fuggo_sorsjegyek='nincs kész';
        $ingatlan->vasarolhato_sorsjegyek=$ingatlan->kibocsajtott_sorsjegyek-$ingatlan->megvasarolt_sorsjegyek;
        $ingatlan->kepek=$kepek->ingatlanKepek($id);
        //unset($ingatlan->extra_szazalek);
        //if (is_array($ingatlan->kepek))
         $ingatlan->defaultImg=$ingatlan->kepek[0];
        $licits=new LicitController();
        $ingatlan->toplista=$licits->showlicitToplista($ingatlan->id);
        $ingatlan->fuggobenVan=$licits->fuggobenleve($ingatlan->id);

        return $ingatlan;
    }
    public function showlicits($id){
        $ingatlan = new Ingatlan();
        return $ingatlan->licit($id);
    }
    public function listWithFilters($query)
    {

        $Ingatlan = new Ingatlan();


        $qb = new QueryBuilder();
        $qb->createQueryFields($query, $Ingatlan->getTable());
        $response = $qb->getResponse();

        if (is_array($response))
        {
            foreach ($response as $ing) {

                $kepek=IngatlanKepek::kepek($ing->id);

                $ing->kepek=$kepek;
                $ing->kibocsajtott_sorsjegyek=ceil($ing->ingatlan_ar/$ing->sorsjegy_ar);

            }

        }
        return $response;

    }



    public function store(CreateIngatlanRequest $request)
    {
        $values = $request->all();


        $newIngatlan = Ingatlan::create($values);
        $kepek=new IngatlanKepek();
        $kepek->where('ingatlan_id', '=',1)->update(array('ingatlan_id' => $newIngatlan->id));
        return response()->json(['msg' => 'oké_new ingatlan', 'Ingatlan' => $newIngatlan], 202);
    }

    public function update(CreateIngatlanRequest $request, $id)
    {



        $Ingatlan=Ingatlan::find($id);

        $Ingatlan->fill($request->all());
     //   file_put_contents('hunk2.log', print_r($request->all(), true));
        $Ingatlan->push();
        return response()->json($Ingatlan);
    }
    public function kivalasztott(){

        $userId=Authorizer::getResourceOwnerId();

        $ingatlan=new Ingatlan();
        $response= $ingatlan->getKivalasztottIngatlanok($userId);

            foreach ($response as $ing) {

                $kepek=IngatlanKepek::kepek($ing->id);
                $ing->kibocsajtott_sorsjegyek=ceil($ing->ingatlan_ar/$ing->sorsjegy_ar);
                $ing->kepek=$kepek;


            }

        return $response;



    }

    public function archive($id)
    {
        $Ingatlan = Ingatlan::find($id);
       // if (!$Ingatlan) return Message::getMessage('IngatlanNotFound');
        $Ingatlan->archive();
        return response()->json(['archivedSucces'=>$Ingatlan]);
    }
}
