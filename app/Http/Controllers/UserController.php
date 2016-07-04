<?php

namespace App\Http\Controllers;

use App\User;
use App\UserKepek;
use App\utils\QueryBuilder;
use Illuminate\Http\Request;
USE App\Http\Requests\CreateUserRequest;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class UserController extends Controller
{

    public function __construct()
    {

        $this->middleware('oauth',['except'=>['store']]);
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
}
