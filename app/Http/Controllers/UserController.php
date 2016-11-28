<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateForgottenpasswordrchangeRequest;
use App\User;
use App\UserKepek;
use App\utils\CommonFunction;
use App\utils\QueryBuilder;
use Illuminate\Http\Request;
USE App\Http\Requests\CreateUserRequest;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function __construct()
    {

        $this->middleware('oauth',['except'=>['store','passwordreminder_send','forgottenpasswordrchange']]);
    }
    public function show($id)
    {

        $User = User::find($id);


        return $User;
    }
    public function showMyData()
    {

        $resourceOwnerId = Authorizer::getResourceOwnerId();
        $User = User::find($resourceOwnerId);


        return $User;
    }

    public function listWithFilters($query)
    {

        $User = new User();


        $qb = new QueryBuilder();
        $qb->createQueryFields($query, $User->getTable());

        $response = $qb->getResponse();
        if (isset($response[0]))
        foreach ($response as $user) {

            unset($user->password);
            unset($user->old_password);

        }
        // $response[0]->kepek=

        return $response;

    }


    public function store(CreateUserRequest $request)
    {

        $values = $request->all();
        $values['password']=\Illuminate\Support\Facades\Hash::make($values['password']);
        $newUser = User::create($values);

       return response()->json(['msg' => 'oké', 'User' => $newUser], 202);
    }

    public function update(CreateUserRequest $request, $id)
    {


        $User = User::find($id);

        $User->fill($request->all());
        $User->push();
        return response()->json($User);
    }
    public function updateCurrent(CreateUserRequest $request)
    {
        $values = $request->all();
        $values['password']=\Illuminate\Support\Facades\Hash::make($values['password']);
        $resourceOwnerId = Authorizer::getResourceOwnerId();
        $User = User::find($resourceOwnerId);

        $User->fill($values);
        $User->push();
        return response()->json($User);
    }


    public function archive($id)
    {
        $User = User::find($id);
        // if (!$User) return Message::getMessage('UserNotFound');
        $User->archive();
        return response()->json(['archivedSucces' => $User]);
    }
    public function passwordreminder_send(Request $request, $email){

            $user=User::where('email',$email)->first();

            $user->reminder=CommonFunction::randomString(50);
           $link= env('HOST_FRONT', 'forge').'changeforgottenpassord/'.$user->reminder;

            $user->save();
        $user['felado']=env('MAIL_FELADO');
        $user['MAIL_FELADO_NAME']=env('MAIL_FELADO_NAME');

        Mail::send('emails.paswordreminder', ['name'=>$user->name,'link'=>$link], function ($message)  use ($user) {


                 $message->from($user->felado, $user->MAIL_FELADO_NAME);
                 $message->subject("Jelszóemlékeztető");
                 $message->to($user->email);
            });


        return response()->json($user);
    }
    public function forgottenpasswordrchange(CreateForgottenpasswordrchangeRequest $request){
      //  file_put_contents('ujpass.log', print_r($request, true));
        $user=User::where('reminder',$request['reminder'])->first();

        if ($user)
        {
            $user->password=\Illuminate\Support\Facades\Hash::make($request['password']);

            $user->save();
            return response()->json(['msg'=>'succes']);
        }
        else
            return response()->json(['msg'=>'Hiba történt! Issmételje meg az új jelszó igénylését']);

    }
}
