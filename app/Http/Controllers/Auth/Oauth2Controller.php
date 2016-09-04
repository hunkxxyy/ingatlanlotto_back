<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class Oauth2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('oauth', ['except' => ['loginPost']]);
    }

    public function loginPost()
    {


        $msg = [
            'oauth' => Authorizer::issueAccessToken(),

            'msg' => 'login success'
        ];


        return response()->json($msg);
    }

    public function usertype()
    {

        $user=User::find(Authorizer::getResourceOwnerId());
        $type=1; //0ot signed, 1 simple user, 2 admin
        switch($user->privilegium)
        {
            case 'ADMIN': $type=2; break;
            default     : $type=1;break;
        }


        return $type;
    }

    public function destroy()
    {


        Authorizer::getChecker()->getAccessToken()->expire();
        return response()->json(['logout' => 'success']);
    }
}
