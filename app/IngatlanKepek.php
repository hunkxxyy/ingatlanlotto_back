<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngatlanKepek extends Model
{
    //ezek a képbeállítási globál paraméterek
    public static $kepmeretek = [
        [
            'nev' => 'kicsi',
            'meret' => 220
        ],
        [
            'nev' => 'kozepes',
            'meret' => 600
        ],
        [
            'nev' => 'nagy',
            'meret' => 1240
        ]

    ];
    public static $meretAzonossag = 'width';
    //---------------------------------------//
    protected $table = 'ingatlan_kepek';
    protected $fillable = ['ingatlan_id', 'name', 'pos', 'file'];
    public $stroageRoot = '/';
    public $stroageName = 'ingatlankepek';


    public function ingatlanKepek($ingatlanId)
    {

        $kepek = $this->where('ingatlan_id', $ingatlanId)->where('archived', 0)->orderBy('pos')->get();
        foreach ($kepek as $k) {
            $k->paths = $this->getPaths($k);
        }
        return $kepek;

    }

    public function customFind($id)
    {
        $kep = $this->where('id', $id)->first();
        $kep->paths = $this->getPaths($kep);
        return $kep;
    }

    private function getPaths($kep)
    {
        $paths = array();
        foreach (IngatlanKepek::$kepmeretek as $meret) {
            $paths[$meret['nev']] = $this->stroageRoot . $this->stroageName . '/' . $kep->id . '/' . $meret['nev'] . '/' . $kep->file;
        }
        return $paths;
    }

    public static function kepek($id)
    {
        $kepek=IngatlanKepek::where('ingatlan_id',$id)->get();
        foreach ($kepek as $k){
            $k['file']='ingatlankepek/'.$k['id'].'/kozepes/'.$k['file'];
        }
        return $kepek;
    }

    public function archive()
    {
        $this->archived = 1;

        $this->save();
    }

    public static function positionRefresh($id)
    {

    }
}

