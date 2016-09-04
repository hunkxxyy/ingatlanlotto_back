<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Licit extends Model
{
    protected $fillable = ['ingatlan_id', 'user_id', 'fake', 'code', 'jovahagyva'];

    //

    public function getall($filter)
    {
        preg_match("/&limit=(.*)&offset=(.*)&orderBy=(.*)&search=(.*)/", $filter, $output_array);
        $limit = $output_array[1];
        $offset = $output_array[2];
        $szures = $output_array[3];
        $search = $output_array[4];
        $licits = DB::table('licits');
        $licits->leftjoin('users', 'users.id', '=', 'licits.user_id');
        $licits->leftjoin('ingatlandb', 'ingatlandb.id', '=', 'licits.ingatlan_id');
        $licits->select('licits.*', 'users.name as user_name', 'users.email as user_email', 'ingatlandb.ingatlan_varos', 'ingatlandb.ingatlan_irsz', 'ingatlandb.ingatlan_cim', 'ingatlandb.tulaj_telefon', 'ingatlandb.tulaj_email', 'ingatlandb.sorsjegy_ar');
        if ($search)
            $licits->where('licits.code', 'like', '%' . $search . '%');
        $licits->orderby('licits.created_at', 'desc');
        $count = $licits->count();
        $licits->take($limit);
        $licits->skip($offset);
        switch ($szures) {
            case 'fizetett':
                $licits->where('licits.jovahagyva', '=', '1');
                break;
            case 'fuggo':
                $licits->where('licits.jovahagyva', '=', '0');
                break;
        }
        $response = $licits->get();

        $response['rowscount'] = $count;
        return $response;
    }

    public function getToplista($ingatlanId)
    {
        $lista = DB::table('licits')->leftjoin('users', 'users.id', '=', 'licits.user_id')->select('users.name', 'users.id')->where('licits.ingatlan_id',$ingatlanId)->get();
        $users=[];
        foreach ($lista as $person) {
            $letezik=false;
            foreach ($users as $key=>$u) {
                if ($u->id==$person->id)
                {
                    $letezik=true;
                    $users[$key]->db++;

                }
            }
            if (!$letezik) {
                $person->db=1;
                preg_match("/(.*)[.| ](.*)/", $person->name, $output_array);
                if (!$output_array) $newName=$person->name[0].'*******';
                else $newName=$output_array[1][0].'****** '.$output_array[2];
                $person->name=$newName;
                $users[]=$person;
            }
        }
        usort($users, function($a, $b) {
            if ($a->db==$b->db) return 0;
            else return ($a->db>$b->db)?-1:1;
        });

        return  array_slice($users, 0, 3);
    }
    public static function  isTicketCountMoreThanMax($r,$userId){
        $darab=DB::table('licits')->where('user_id',$userId)->where('ingatlan_id',$r['ingatlan_id'])->count();
        return  ($darab>=5);

    }
}
