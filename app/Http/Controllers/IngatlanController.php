<?php

namespace App\Http\Controllers;

use App\Ingatlan;
use App\IngatlanKepek;
use App\utils\QueryBuilder;
use Illuminate\Http\Request;
USE App\Http\Requests\CreateIngatlanRequest;


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

        $ingatlan->kepek=$kepek->ingatlanKepek($id);

        return $ingatlan;
    }

    public function listWithFilters($query)
    {

        $Ingatlan = new Ingatlan();


        $qb = new QueryBuilder();
        $qb->createQueryFields($query, $Ingatlan->getTable());
        $response = $qb->getResponse();
       // $response[0]->kepek=

        foreach ($response as $ing) {
           // $this->getKep($ing);
            //$kepek=IngatlanKepek::where('ingatlan_id',$ing->id)->get();
            $kepek=IngatlanKepek::kepek($ing->id);
            $ing->kepek=$kepek;
           /* if (isset($kepek[0]))
             $ing->mainPic=$kepek[0]['file'];
            else
                $ing->mainPic='"http://lorempixel.com/400/300/?72902"';*/
        }
        return $response;

    }



    public function store(CreateIngatlanRequest $request)
    {
        $values = $request->all();

        $newIngatlan = Ingatlan::create($values);
        $kepek=new IngatlanKepek();
        $kepek->where('ingatlan_id', '=', 0)->update(array('ingatlan_id' => $newIngatlan->id));
        return response()->json(['msg' => 'oké', 'Ingatlan' => $newIngatlan], 202);
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
