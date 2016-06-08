<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class Oauth2Controller extends Controller
{
    public function loginPost(){


        $msg=[
            'oauth'=>Authorizer::issueAccessToken(),
            'msg'=>'Sikerse bejelentkezés [szerveroldalon generált üzenet]'
        ];
        return response()->json($msg);
    }
}
