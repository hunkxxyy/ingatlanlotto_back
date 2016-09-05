<?php

namespace App\Http\Controllers;

use App\HtmlContents;
use Illuminate\Http\Request;

use App\Http\Requests;

class HtmlContentsController extends Controller
{
    public function getAll()
    {

        $all = HtmlContents::all();
        $r=[];
        foreach ($all as $part) {
            if ($part['tartalom']=='') $part['tartalom']="Nincsen beállított tartalom";
            $r[$part['index']] =['id'=>$part['id'],'content'=>$part['tartalom'],'title'=>$part['title']] ;
        }
        return response()->json($r);
    }

    public function update(Request $request, $id)
    {
        $new = HtmlContents::find($id);
        /* $all=$request->all();
         $request['content']=nl2br($all['content']);*/
        $new->fill($request->all());
        $new->push();
        return response()->json($new);
    }
}
