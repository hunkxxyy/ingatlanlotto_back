<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Licit extends Model
{
    protected $fillable=['ingatlan_id','user_id','fake','code','jovahagyva'];
    //

    public function getall($filter){
        preg_match("/&limit=(.*)&offset=(.*)&orderBy=(.*)&search=(.*)/",$filter, $output_array);
        $limit=$output_array[1];
        $offset=$output_array[2];
        $szures=$output_array[3];
        $search=$output_array[4];
        $licits=DB::table('licits');
        $licits->leftjoin('users', 'users.id', '=', 'licits.user_id');
        $licits->leftjoin('ingatlandb', 'ingatlandb.id', '=', 'licits.ingatlan_id');
        $licits->select('licits.*','users.name as user_name','users.email as user_email','ingatlandb.ingatlan_varos','ingatlandb.ingatlan_irsz','ingatlandb.ingatlan_cim','ingatlandb.tulaj_telefon','ingatlandb.tulaj_email','ingatlandb.sorsjegy_ar');
        if ($search)
            $licits->where('licits.code','like','%'.$search.'%');
        $licits->orderby('licits.created_at','desc');
        $count=$licits->count();
        $licits->take($limit);
        $licits->skip($offset);
        switch($szures){
            case 'fizetett':
                $licits->where('licits.jovahagyva','=','1');
                break;
            case 'fuggo':
                $licits->where('licits.jovahagyva','=','0');
                break;
        }
        $response=$licits->get();

        $response['rowscount']=$count;
    return  $response;
    }
}
