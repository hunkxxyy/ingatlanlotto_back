<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ingatlan extends Model
{
    protected $table = 'ingatlandb';
    protected $fillable = [
        'pos',
        'tulaj_varos',
        'tulaj_irsz',
        'tulaj_cim',
        'tulaj_email',
        'tulaj_telefon',
        'ingatlan_varos',
        'ingatlan_irsz',
        'ingatlan_cim',
        'ingatlan_telek_nm2',
        'ingatlan_nm2',
        'tulaj',
        'ingatlan_szobak',
        'ingatlan_garazs',
        'ingatlan_leiras',
        'ingatlan_ar',
        'sorsjegy_ar',
        'szazalek_ertekesitve',
        'extra_szazalek'];

    var $kivalasztottIngatlanIds = [];

    public function kepek()
    {
        dd($this->hasMany('App\IngatlanKepek'));
        return $this->hasMany('App\IngatlanKepek');
    }

    public function archive()
    {
        $this->archived = 1;

        $this->save();
    }

    public function licit($id)
    {
        //$licits=DB::table('licits')->join('users', 'users.id', '=', 'licits.ingatlan_id')->where('licits.ingatlan_id','=',$id)->orderby('licits.created_at','desc')->get();
        $licits = DB::table('licits')->
        leftjoin('users', 'users.id', '=', 'licits.user_id')
            ->select('licits.*', 'users.name as user_name', 'users.email as user_email')
            ->where('licits.ingatlan_id', '=', $id)
            ->orderby('licits.created_at', 'desc')
            ->get();
        return $licits;
    }

    public function getKivalasztottIngatlanok($userId)
    {
        $response = DB::table('licits')->where('user_id', $userId)->get();
        $compressed = [];
        $ingatlanIds = [];
        foreach ($response as $ingatlan) {
            $rogzitve = false;
            foreach ($compressed as $tarolt) {
                if ($tarolt->ingatlan_id == $ingatlan->ingatlan_id) {
                    $rogzitve = true;
                    $tarolt->vasaroltJegyek += 1;
                    if ($ingatlan->jovahagyva) $tarolt->jovahagyottJegyek += 1;
                }
            }
            if (!$rogzitve) {
                $ingatlanIds[] = $ingatlan->ingatlan_id;
                $ingatlan->vasaroltJegyek = 1;
                if ($ingatlan->jovahagyva) $ingatlan->jovahagyottJegyek = 1; else $ingatlan->jovahagyottJegyek = 0;
                $compressed[] = $ingatlan;
            }

        }
        $ingatlanok = $this->getListaByIds($ingatlanIds);
        foreach ($ingatlanok as $key => $ingatlan) {

            foreach ($compressed as $c) {
                if ($c->ingatlan_id == $ingatlan->id) {

                    $ingatlan->vasaroltJegyek = $c->vasaroltJegyek;
                    $ingatlan->jovahagyottJegyek = $c->jovahagyottJegyek;
                }
            }
        }
        return $ingatlanok;
    }

    private function getListaByIds($ids)
    {
        /*$query=$this->where(
            function ($q){
                $q->where('archived', '0')->whereIn('id', $ids);
            }
        )->toSql();
        file_put_contents('hunk2.log',$query);*/
        $this->kivalasztottIngatlanIds = $ids;
        return $this->where(
            function ($q) {

                $q->whereIn('id', $this->kivalasztottIngatlanIds)->where('archived', 0);
            }
        )->get();
    }
}

