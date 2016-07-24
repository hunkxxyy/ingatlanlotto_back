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
        'szazalek_ertekesitve'];

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
        $licits=DB::table('licits')->
        leftjoin('users', 'users.id', '=', 'licits.user_id')
            ->select('licits.*','users.name as user_name','users.email as user_email')
            ->where('licits.ingatlan_id','=',$id)
            ->orderby('licits.created_at','desc')
            ->get();
        return $licits;
    }
}

