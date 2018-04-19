<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Api\TheTvApi;

class SearchController extends Controller
{
    public function user(Request $request){
        
        $query = User::query();  //Questa riga deve essere sempre prima dell'if
        
        $query->where('id', '!=', auth()->id());
        
        if($request->has('q')){
            
            $query->where(function($query) use ($request){    // Permette di racchiudere una funzione query
                
                $query->where('name', 'like', '%'.$request->input('q').'%')  // Permette di ricercare il name di un utente registrato nel database
                  ->orWhere('surname', 'like', '%'.$request->input('q').'%') // Permette di ricercare l'username di un utente registrato nel database
                    ->orWhere('nickname', 'like', '%'.$request->input('q').'%') // Permette di ricercare il nickname di un utente registrato nel database
                     ->orWhere('email', 'like', '%'.$request->input('q').'%'); // Permette di ricercare l'email di un utente registrato nel database
                            
                
            });
        
            // string% = inizia con stringa
            // %stringa% = contiene stringa
            // %stringa = finisce con stringa
        
            
        }
        
        $users = $query->paginate(5);  //permette di creare il numero dei valori all'interno del database a ogni pagina (se ho 50 persone registrate nel database, usando il 5 permette di far visualizzare dentro la tabella 5 utenti a pagina)
        
        return view('search.user', compact('users'));  
    }
    
    public function serie(Request $request)
    {
        $series = [];
        if($request->filled('q')){
        
         $api = new TheTvApi;
        
        $response = ($api->search($request->input('q')));
            
    $series = empty($response->data) ? [] : $response->data; // Permette di non dare dati se non corrisponde il risultato
    
        }
        return view('search/serie', compact('series'));
    }
}
