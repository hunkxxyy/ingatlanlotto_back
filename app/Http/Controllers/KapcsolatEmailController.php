<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests\CreateKapcsolatEmailRequest;
use Illuminate\Support\Facades\Mail;

class KapcsolatEmailController extends Controller
{
   public function sendemail(CreateKapcsolatEmailRequest $request)
   {



/*      $user=User::find(2); //az 1 én vagyok, a 2 a user email
      $user['felado']=$request['email'];
      $user['MAIL_FELADO_NAME']=$request['name'] ;

      $user['name']=$request['name'] ;
      $user['phone']=$request['phone'] ;
      $user['msg']=$request['comments'] ;

      $user['MAIL_FELADO_NAME']=env('MAIL_FELADO_NAME');

      Mail::send('emails.kapcsolatfelvetel', ['name'=>'hunk','user'=>$user], function ($message) use ($user){
         $message->from($user->felado, $user->MAIL_FELADO_NAME);
         $message->to($user->email)->cc($user->felado);
      });*/



      $user=User::find(2);
      $user['name']=$request['name'] ;
      $user['phone']=$request['phone'] ;
      $user['msg']=$request['comments'] ;
      $user['cc']=env('MAIL_CC');
      $user['felado']=$request['email'];
      $user['MAIL_FELADO_NAME']=$request['name'] ;

      Mail::send('emails.kapcsolatfelvetel',  ['name'=>'hunk','user'=>$user], function ($message) use ($user){
         $message->from($user->felado, $user->MAIL_FELADO_NAME);
         $message->to($user->cc);
         $message->subject("Kapcsolatfelvétel az oldalról");

      });


      return response()->json(['success'=>'Köszönjük levelét, hamarosan válaszolunk.']);
   }
}
