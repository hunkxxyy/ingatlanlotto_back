<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class Oauth2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('oauth',['except'=>['loginPost']]);
    }
    public function loginPost(){


        $msg=[
            'oauth'=>Authorizer::issueAccessToken(),
            'msg'=>'login success'
        ];
        return response()->json($msg);
    }
    public function destroy(){



        Authorizer::getChecker()->getAccessToken()->expire();
        return response()->json(['logout'=>'success']);
    }
}
