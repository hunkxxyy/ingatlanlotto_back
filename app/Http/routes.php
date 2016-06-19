<?php



Route::get('/', function () {
    return view('welcome');
});

/*todo: Megjegyzés az oauth2vel kapcsolatban
a client secret ssh titkosított ez okoz problémát. Figyelj rá*/


Route::post('oauth/acces_token','Auth\Oauth2Controller@loginPost');
Route::get('oauth/exit/','Auth\Oauth2Controller@destroy');



Route::get('Szintek/menu','SzintekController@menu');
Route::get('Szintek/menulogged','SzintekController@menuLogged');
//Route::get('Szintek/menu/{token}','SzintekController@menu');
Route::get('Szintek/tartalom/{szint_id}','SzintekController@tartalom');
Route::get('/register',function(){$user = new App\User();
    $user->name="hunk";
    $user->email="hunk74@gmail.com";
    $user->password = \Illuminate\Support\Facades\Hash::make("Editke76");
    $user->save();
});

Route::get('register/admin',function(){$user = new App\User();
    $user->name="admin";
    $user->email="admin@gmail.com";
    $user->password = \Illuminate\Support\Facades\Hash::make("jelszó");
    $user->save();
});




Route::get('git/pull','GitController@pull');

/*-------------------------------- USER --------------------------------------*/
Route::get('api/users/{query}','UserController@listWithFilters');
Route::get('api/user/{id}','UserController@show');
Route::post('api/user/','UserController@store');
Route::put('api/user/modify/{id}','UserController@update');
Route::put('api/user/archive/{id}','UserController@archive');

/*-------------------------------- INGATLADB --------------------------------------*/
Route::get('api/ingatlans/{query}','IngatlanController@listWithFilters');
Route::get('api/ingatlan/{id}','IngatlanController@show');
Route::post('api/ingatlan/','IngatlanController@store');
Route::put('api/ingatlan/modify/{id}','IngatlanController@update');
Route::put('api/ingatlan/archive/{id}','IngatlanController@archive');

/*-------------------------------- INGATLANIngatlanKepek --------------------------------------*/

Route::get('api/ingatlan_kepeks/{query}','IngatlanKepekController@listWithFilters');
Route::get('api/ingatlan_kepek/dir/','IngatlanKepekController@makedir');
Route::get('api/ingatlan_kepek/{id}','IngatlanKepekController@show');
Route::post('api/ingatlan_kepek/','IngatlanKepekController@store');
Route::put('api/ingatlan_kepek/modify/{id}','IngatlanKepekController@update');
Route::put('api/ingatlan_kepek/archive/{id}','IngatlanKepekController@archive');
