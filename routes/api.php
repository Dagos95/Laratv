<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


// Visto che in defoult AuthenticateController@authenticate viene ricercato direttamente dentro la cartella Controller, bisogna specificare la percorso della cartella Api
Route::group(['namespace' => 'Api'], function(){
    
    Route::post('authenticate', 'AuthenticateController@authenticate');
    
    
    
    Route::group(
        ['middleware' => 'auth:api'], function()
        {
           Route::get('me', function(){
               
               $user = auth('api')->user();
               
               $userResource = new App\Http\Resources\UserResource($user);
               
              return response()->json($userResource);
           });
            Route::post('refresh', 'AuthenticateController@refresh');
        }
    );
   
});

