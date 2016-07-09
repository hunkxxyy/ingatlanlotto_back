<?php

namespace App\Http\Controllers;

use App\IngatlanKepek;

use App\utils\CommonFunction;
use App\utils\QueryBuilder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;

//use App\Http\Requests;
USE App\Http\Requests\CreateIngatlanKepekRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Filesystem\Filesystem;


class IngatlanKepekController extends Controller
{


    public function __construct()
    {

      //  $this->middleware('oauth',['except'=>['show','listWithFilters']]);
    }
    public function show($id)
    {
        $ingatlan = new IngatlanKepek();
        return $ingatlan->customFind($id);
    }

    public function listWithFilters($query)
    {

        $ingatlanKepek = new IngatlanKepek();


        $qb = new QueryBuilder();
        $qb->createQueryFields($query, $ingatlanKepek->getTable());
        $response = $qb->getResponse();
        foreach ($response as $r) {
            $r->paths=$ingatlanKepek->customFind($r->id)->paths;
        }

        return $response;

    }

    public function store(CreateIngatlanKepekRequest $request)
    {
        $kepek = new IngatlanKepek();
        $count = $kepek->where('ingatlan_id', $request->ingatlan_id)->where('archived', 'false')->count();
        $values = $request->all();
        $fileName = $this->setName($request);
       // file_put_contents('store_kep.log', print_r($values, true));
        $newkep = IngatlanKepek::create($values);
        $newkep->name = $fileName;
        $newkep->file = $fileName;
        $newkep->pos = $count;
        $newkep->save();
        $mainDir = $this->createPaths($newkep->id);
        //  file_put_contents('hunk2.log', print_r($_FILES, true));

        if ($newkep) {
            $currentPath = env('HOST_URL', 'forge');
            $tmpfilePath = 'storage/app/tmp';
            if (Input::file('file')->isValid()) {

                // file_put_contents ( 'hunk2.log' ,$mainDir.'/'.$fileName );
                Input::file('file')->move($mainDir, $fileName);
                $this->saveKepek($mainDir, $fileName);
            }
            // $fileName = CommonFunction::hungarianToEnglishConvert($newkep->name);


        }
        return response()->json(['upload' => 'sikeres', 'URL:' => $currentPath]);
    }

    private function setName($request)
    {
        // file_put_contents ( 'hunk2.log' ,print_r($_FILES,true) );
        $extension = \Illuminate\Support\Facades\File::extension($_FILES['file']['name']);
        $name = ($request->name && $request->name != 'undefined') ? CommonFunction::hungarianToEnglishConvert($request->name) . '.' . $extension : CommonFunction::hungarianToEnglishConvert($_FILES['file']['name']);


        return $name;

    }

    private function createPaths($picId)
    {
        $mainDir = 'ingatlankepek/' . $picId;
        foreach (IngatlanKepek::$kepmeretek as $meret) {
            $dir= $mainDir . '/' . $meret['nev'];
           File::makeDirectory($dir, 0777,true,true);
           chmod($dir, 0777);

        }
        return  $mainDir;


    }
    public function makedir()
    {

        /*    Storage::makeDirectory('teszt1/' , 0777);
            File::makeDirectory( 'ingatlankepek/1974/kicsi' , 0777,true,true);
        chmod('../storage/appp/teszt1', 0777);*/
        $mainDir = 'ingatlankepek/1974';
        foreach (IngatlanKepek::$kepmeretek as $meret) {
            $dir= $mainDir . '/' . $meret['nev'];
            print $dir;
            File::makeDirectory($dir , 0777,true,true);
            chmod($dir, 0777);

        }

      /*  $fs=new Filesystem();
        $fs->makeDirectory('teszt3');*/


    }
    private function saveKepek($path, $file)
    {

        list($width, $height) = getimagesize($path . '/' . $file);
        foreach (IngatlanKepek::$kepmeretek as $meret) {
            $ratio=$width/$height;
            $newWidth=$meret['meret']*$ratio;
            $cmd = "convert  -limit thread 1 -colorspace RGB " . $path . "/" . $file . " -resize " . $newWidth . "x" .$meret['meret'] . "! " . $path . "/" . $meret['nev'] . "/" . $file;
           //file_put_contents('hunk2.log', $cmd);
            system($cmd);
        }


    }


    public function update(CreateIngatlanKepekRequest $request, $id)
    {

        $Item = IngatlanKepek::find($id);
        //   if (!$Item)return Message::getMessage('ItemNotFound');
        file_put_contents('hunk1.log', print_r($Item,true) . ', ' . $Item->pos);
        if ($request->pos != $Item->pos) {
            $ingatlanKep = new IngatlanKepek();
            $elozoApozicion = $ingatlanKep->where('pos', $request->pos)->where('ingatlan_id', $request->ingatlan_id)->first();
            $elozoApozicion->pos = $Item->pos;
            $elozoApozicion->push();
        }

        $Item->fill($request->all());
        $Item->push();


        return response()->json($Item);
    }

    public function archive($id)
    {
        $Item = IngatlanKepek::find($id);
        //   if (!$Item) return Message::getMessage('ItemNotFound');
        $Item->archive();
        return response()->json(['msg' => 'Arhiválás sikeres', 'termekkeép' => $Item]);
    }

}
