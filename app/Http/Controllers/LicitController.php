<?php

namespace App\Http\Controllers;



use App\Ingatlan;
use App\Licit;
use App\utils\QueryBuilder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateLicitRequest;
use Illuminate\Support\Facades\Mail;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Support\Facades\DB;

class LicitController extends Controller
{

    public function __construct()
    {

       $this->middleware('oauth');
    }
    public function store(Request $request){
        $userId=Authorizer::getResourceOwnerId();

       if (Licit::isTicketCountMoreThanMax($request->all(),$userId))
            return response()->json(
                ['msg'=>[
                    'title'=>'Maximum sorjegy szám elérve!',
                    'body'=>'Az egy ingatlanra  megvásárolható sorsjegyek száma elérte a maximumut 5db.!'
                ]
                    ,'return'=>'overflow']);

        $codeNotExist=false;
        $code=0;
        while (!$codeNotExist){
            $code=rand(100000,500000);;
            $ch=Licit::where('code','=',$code)->first();
            if (!$ch)
                $codeNotExist=true;

        }

      $request['code']=$code;
        $ingatlan=Ingatlan::find($request['ingatlan_id']);


        $values = $request->all();
        $values['user_id']=$userId;
        $kibocsajtott_sorsjegyek=ceil($ingatlan->ingatlan_ar/$ingatlan->sorsjegy_ar);
        $megvasarolt_sorsjegyek=DB::table('licits')->where('ingatlan_id',$ingatlan->id)->count();
          $megvasarolt_sorsjegyek++;
        $ingatlan->szazalek_ertekesitve=ceil(($megvasarolt_sorsjegyek/$kibocsajtott_sorsjegyek)*100)+$ingatlan->extra_szazalek;
        $ingatlan->save();
      //  file_put_contents('hunk2.log', print_r($values, true),FILE_APPEND );
         Licit::create($values);

        $this->sendEmail($userId,$code,$ingatlan['sorsjegy_ar']);
        $savedIngatlan=new IngatlanController();
        $kivalasztott=$savedIngatlan->kivalasztott();

        return response()->json(['msg'=>'sikeres szavazás','return'=>$ingatlan->szazalek_ertekesitve,'kivalasztott_ingatlanok'=>$kivalasztott]);
    }
    private function sendEmail($userid,$code, $price){

        $user=User::find($userid);
        $user['felado']=env('MAIL_FELADO');
        $user['MAIL_FELADO_NAME']=env('MAIL_FELADO_NAME');
        $user['cc']=env('MAIL_CC');
        Mail::send('emails.megrendelve', ['name'=>$user->name,'user'=>$user,'code'=>$code, 'price'=>$price], function ($message) use ($user){
            $message->from($user->felado, $user->MAIL_FELADO_NAME);
            $message->subject("Vásárlás menete");
            $message->to($user->email)->cc($user->cc);
        });
        return response()->json(['status:'=>'Succes']);
    }

    public function listWithFilters($query)
    {

        $new=new Licit();


        $qb = new QueryBuilder();
        $qb->createQueryFields($query, $new->getTable());
        $response = $qb->getResponse();

        return $response;

    }
    public function all($filter){
        $licit=new Licit();
        $response=$licit->getall($filter);
        $count=$response['rowscount'];
        unset($response['rowscount']);
        return response()->json(['rows'=>$response,'rowscount'=>$count]) ;

    }
    public function fizetve(Request $request,$id){
        $licit=Licit::find($id);

        $all=$request->all();
        $licit->fill($all);
        $licit->push();
        $licitall=$this->all('&limit=50&offset=0&orderBy=all&search='.$all['code']);
        $this->sendEmailJovahagyva($licit->toArray());

        return $licitall;
    }
    private function sendEmailJovahagyva($licit){
   /*     $user=User::find($licit['user_id']);
        $user['felado']=env('MAIL_FELADO');
        $user['MAIL_FELADO_NAME']=env('MAIL_FELADO_NAME');

        Mail::send('emails.fizetve', ['name'=>'hunk','user'=>$user], function ($message) use ($user){
            $message->from($user->felado, $user->MAIL_FELADO_NAME);
            $message->subject("Befizetését jóváhagytuk!");
            $message->to($user->email)->cc($user->felado);
        });*/


        $user=User::find($licit['user_id']);
        $user['felado']=env('MAIL_FELADO');
        $user['MAIL_FELADO_NAME']=env('MAIL_FELADO_NAME');
        $user['cc']=env('MAIL_CC');
        Mail::send('emails.fizetve', ['name'=>$user->name,'user'=>$user], function ($message) use ($user){
            $message->from($user->felado, $user->MAIL_FELADO_NAME);
            $message->subject("Megrendelését aktiváltuk!");
            $message->to($user->email)->cc($user->cc);
        });
        return response()->json(['status:'=>'Succes']);
    }
    public function showlicitToplista($ingatlanId){
        $licit=new Licit();
        return $licit->getToplista($ingatlanId);
    }
    public function fuggobenleve($id){

        return Licit::where('ingatlan_id',$id)->where('jovahagyva','0')->count();
    }
    public function sendTesztEmail(){

        $user=User::find(1);
        $user['felado']=env('MAIL_FELADO');
        $user['MAIL_FELADO_NAME']=env('MAIL_FELADO_NAME');
        $user['cc']=env('MAIL_CC');
        Mail::send('emails.fizetve', ['name'=>$user->name,'user'=>$user], function ($message) use ($user){
            $message->from($user->felado, $user->MAIL_FELADO_NAME);
            $message->subject("Megrendelését aktiváltuk!");
            $message->to($user->email)->cc($user->cc);
        });
        return response()->json(['status:'=>'Succes']);
    }
}
