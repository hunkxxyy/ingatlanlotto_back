<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class PasswordVerifier extends Controller
{
    public function verify($userName, $password){

        $credentials=[
            'email'=>$userName,
            'password'=>$password
        ];
        file_put_contents('hunk3.log', print_r( $credentials, true));
        if (Auth::once($credentials)){

            return Auth::user()->id;
        }

        return false;


    }
}
