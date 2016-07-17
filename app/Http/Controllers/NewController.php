<?php

namespace App\Http\Controllers;

use App\News;
use App\utils\QueryBuilder;
use App\Http\Requests\CreateNewsRequest;

use App\Http\Requests;

class NewController extends Controller
{
    public function show($id)
    {

        return News::find($id);
    }
    public function listAll(){

        $new=new News();
        $response=$new->orderBy('created_at', 'desc')->get();
        return $response;

    }
    public function listWithFilters($query)
    {

        $new=new News();


        $qb = new QueryBuilder();
        $qb->createQueryFields($query, $new->getTable());
        $response = $qb->getResponse();
        return $response;

    }
    public function update(CreateNewsRequest $request, $id){

        $new=News::find($id);
       /* $all=$request->all();
        $request['content']=nl2br($all['content']);*/
        $new->fill($request->all());
        $new->push();
        return response()->json($new);
    }
    public function archive($id)
    {
        $new=News::find($id);
        // if (!$Ingatlan) return Message::getMessage('IngatlanNotFound');
        $new->archive();
        return response()->json(['archivedSucces'=>$new]);
    }
    public function store(CreateNewsRequest $request)
    {
        $values = $request->all();


        $newHir = News::create($values);


        return response()->json(['msg' => 'oké_new ingatlan', 'Ingatlan' => $newHir], 202);
    }

}
