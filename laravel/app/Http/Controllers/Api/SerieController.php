<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Api\TheTvApi;

use App\Serie;

class SerieController extends Controller
{
    public function index(Request $request)
    {
        $series = [];
        if($request->filled('q')){
        
         $api = new TheTvApi;
        
        $response = ($api->search($request->input('q')));
            
        $series = empty($response->data) ? [] : $response->data;
        }
        
        return response()->json($series);
    }
    
    public function show(Serie $serie)
    {
        return response()->json($serie->getData());
    }
    
    public function follow(Serie $serie)
    {
        $user = auth()->user();
        $user->series()->attach($serie->id);
        return response()->json([
           'status' => 'ok', 
        ]);
    }
    
    public function unfollow(Serie $serie)
    {
        $user = auth()->user();
        $user->series()->detach($serie->id);
        return response()->json([
           'status' => 'ok', 
        ]);
    }
}
