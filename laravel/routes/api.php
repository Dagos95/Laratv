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
    Route::post('registration', 'AuthenticateController@registration');
    
    
    Route::group(
        ['middleware' => 'auth:api'], function()
        {
           Route::get('me', function(){
               
               $user = auth('api')->user();
               
               $userResource = new App\Http\Resources\UserResource($user);
               
              return response()->json($userResource);
           });
            Route::post('refresh', 'AuthenticateController@refresh');
            
            Route::bind('series', function($hetv_id){
                
                $serie = App\Serie::where('thetv_id', $thetv_id)->first();
                
                if( empty($serie)){
            
                $serie = new App\Serie([
                   'thetv_id' => $thetv_id 
                ]);
                $serie->fetchData();
                $serie->save();
                    
                }
                
                return $serie;
                    
            });
            
            Route::resource('series', 'SerieController', [ 'only' => [ 'index', 'show' ] ]);
            
            Route::post('series/{series}/follow', 'SerieController@follow');
            
            Route::post('series/{series}/unfollow', 'SerieController@unfollow');
        }
    );
    
    
   
});

