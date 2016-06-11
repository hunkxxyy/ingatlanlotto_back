<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/acces_token','Auth\Oauth2Controller@loginPost');
Route::post('oauth/acces_token','Auth\Oauth2Controller@loginPost');
//Route::resource('Szintek','SzintekController');
Route::get('Szintek/menu','SzintekController@menu');
Route::get('Szintek/tartalom/{szint_id}','SzintekController@tartalom');
Route::get('/register',function(){$user = new App\User();
    $user->name="hunk";
    $user->email="hunk74@gmail.com";
    $user->password = \Illuminate\Support\Facades\Hash::make("Editke76");
    $user->save();
});


Route::get('git/pull','GitController@pull');

/*-------------------------------- INGATLADB --------------------------------------*/
Route::get('api/ingatlans/{query}','IngatlanController@listWithFilters');
Route::get('api/ingatlan/{id}','IngatlanController@show');
Route::post('api/ingatlan/','IngatlanController@store');
Route::put('api/ingatlan/modify/{id}','IngatlanController@update');
Route::put('api/ingatlan/archive/{id}','IngatlanController@archive');

/*-------------------------------- INGATLADB --------------------------------------*/

Route::get('api/ingatlan_kepeks/{query}','IngatlanKepekController@listWithFilters');
Route::get('api/ingatlan_kepek/dir/','IngatlanKepekController@makedir');
Route::get('api/ingatlan_kepek/{id}','IngatlanKepekController@show');
Route::post('api/ingatlan_kepek/','IngatlanKepekController@store');
Route::put('api/ingatlan_kepek/modify/{id}','IngatlanKepekController@update');
Route::put('api/ingatlan_kepek/archive/{id}','IngatlanKepekController@archive');
