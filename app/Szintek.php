<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Szintek extends Model
{
    protected $table = 'szintek';

    public function getMenu($user='')
    {
        $menuArr[] = [
            'caption' => 'Ingatlanok',
            'link' => 'ingatlanok',
            'submenu' => [[
                'caption' => 'Licitalható ingatlanok',
                'link' => 'licitalhato-ingatlanok',

            ], [
                'caption' => 'Lictált Ingatlanok',
                'link' => 'licitalt-ingatlanok',

            ]]
        ];

        $query=DB::table($this->table);
        $query->where('parent', '2');
        if ($user!='admin')
            $query->where('id','!=', '11'); //admin menüpont
        $menus=$query->get();

        foreach ($menus as $menu) {

            $menuArr[] = [
                'caption' => $menu->nev,
                'link' => $menu->link,
                'submenu' => $this->submenu($menu->id)
            ];

        }
        return compact('menuArr');
        //print_r($menuArr);
        /*        'caption': 'caption',
                    'link': 'link',*/
    }
    
    private function submenu($id){
        $menuArr=[];
        $menus = $this->where('parent', '=', $id)->get();
        foreach ($menus as $menu) {
           $menuArr[] = [
                'caption' => $menu->nev,
                'link' => $menu->link

            ];

        }
        return $menuArr;
    }
    public function getTartalom($szint_id){

        $szint=$this->where('link',$szint_id)->first();
       $htmls= DB::table('responsive_oldalak')->where('szint_id','=',$szint->id)->get();
        return $htmls;
    }
}
