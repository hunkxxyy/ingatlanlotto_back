<?php
namespace App\Http\Controllers;
use App\Szintek;
use Illuminate\Http\Request;
use App\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class SzintekController extends Controller
{
    public function __construct()
    {

        $this->middleware('oauth',['except'=>['menu']]);
    }
    public function index(){
        return Szintek::all();
    }
    public function menu(){

         $szintek=new Szintek();
        $response=$szintek->getMenu();

        return $response;
    }
    public function menuLogged(){

        $szintek=new Szintek();
        $response=$szintek->getMenu('admin');
        return $response;
    }
    public function tartalom($szint_id){
        $szintek=new Szintek();
        return $szintek->getTartalom($szint_id);
    }
}