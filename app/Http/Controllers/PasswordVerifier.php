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
            'password'=>$password,
        ];

        if (Auth::once($credentials)){
            return Auth::user()->id;
        }
        return false;


    }
}
