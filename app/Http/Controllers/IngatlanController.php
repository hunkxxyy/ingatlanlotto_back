<?php

namespace App\Http\Controllers;

use App\Ingatlan;
use App\IngatlanKepek;
use App\utils\QueryBuilder;
use Illuminate\Http\Request;
USE App\Http\Requests\CreateIngatlanRequest;
use Illuminate\Support\Facades\DB;

class IngatlanController extends Controller
{

    public function __construct()
    {

     //   $this->middleware('oauth',['except'=>['show','listWithFilters']]);
    }
    public function show($id)
    {
        $kepek=new IngatlanKepek();
        $ingatlan = Ingatlan::find($id);
        $ingatlan->kibocsajtott_sorsjegyek=ceil($ingatlan->ingatlan_ar/$ingatlan->sorsjegy_ar);
        $ingatlan->megvasarolt_sorsjegyek=DB::table('licits')->where('ingatlan_id',$ingatlan->id)->count();
        $ingatlan->fuggo_sorsjegyek='nincs kész';
        $ingatlan->vasarolhato_sorsjegyek=$ingatlan->kibocsajtott_sorsjegyek-$ingatlan->megvasarolt_sorsjegyek;
        $ingatlan->kepek=$kepek->ingatlanKepek($id);
        if (is_array($ingatlan->kepek))
         $ingatlan->defaultImg=$ingatlan->kepek[0];
        return $ingatlan;
    }

    public function listWithFilters($query)
    {

        $Ingatlan = new Ingatlan();


        $qb = new QueryBuilder();
        $qb->createQueryFields($query, $Ingatlan->getTable());
        $response = $qb->getResponse();
       // $response[0]->kepek=
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
        $kepek->where('ingatlan_id', '=', 0)->update(array('ingatlan_id' => $newIngatlan->id));
        return response()->json(['msg' => 'oké_new ingatlan', 'Ingatlan' => $newIngatlan], 202);
    }

    public function update(CreateIngatlanRequest $request, $id)
    {



        $Ingatlan=Ingatlan::find($id);

        $Ingatlan->fill($request->all());
        $Ingatlan->push();
        return response()->json($Ingatlan);
    }


    public function archive($id)
    {
        $Ingatlan = Ingatlan::find($id);
       // if (!$Ingatlan) return Message::getMessage('IngatlanNotFound');
        $Ingatlan->archive();
        return response()->json(['archivedSucces'=>$Ingatlan]);
    }
}
