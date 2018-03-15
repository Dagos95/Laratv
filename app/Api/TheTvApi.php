<?php

namespace App\Api;

use Ixudra\Curl\Facades\Curl;

use Cache;

class TheTvApi {
    
    public function login()
    {
        
        $response = Curl::to('https://api.thetvdb.com/login')
        ->withData( config('thetv.login')   // Prende i valori dentro config > thetv.php
          )
        ->asJson()
        ->post();
        
        return $response;
    }
    
    public function getToken()
    {
        return Cache::remember('the_tv_token', 1410, function(){ // Permette di memorizzare il cache fino a 1410 minuti   // the_tv_token è una variabile inventata
            return $this->login()->token;  // Richiamo il public login e riprendo il token
        });  
      
    }
    
    protected function getCurl($uri)
    {
        return Curl::to('https://api.thetvdb.com/' . ltrim($uri, '/'))
                    ->asJson()
            
             // withHeader permette di mandare i dati in base al codice inserito
            
                    ->withHeader('Accept-Language: it')  // Imposta la lingua italiana 
                    ->withHeader('Authorization: Bearer ' . $this->getToken());  // Questa è un'autenticazione che permette di far funzionare la ricerca prendendo il token
    }
    
    public function search($value)
    {
        $response = $this->getCurl('/search/series')  // Richiama la function getCurl, quindi riprende le funzioni della function di getCurl     // Funziona solamente se sulla barra URL viene riportato il search/series
                      ->withData([
                               'name' => $value 
                            ])
                    ->get();
        
        return $response;
    }
    
    public function getSerie($id)
    {
        $response =  $this->getCurl('/series/' . $id)
                    ->get();
        
        return $response->data;
    }
    
    public function getPosters($id)  // Per salvare i posters al database
    {
        $response =  $this->getCurl('/series/' . $id . '/images/query')
            
                     ->withData([
                         'keyType' => 'poster' 
                     ])
            
                    ->get();
        
        return collect(!empty($response->data) ? $response->data : [])->map(function($istem){   // Collect trasforma l'array in collection
            $item->fileName = 'https://www.thetvdb.com/banners/' . $item->fileName;
            $item->thumbnail = 'https://www.thetvdb.com/banners/' . $item->thumbnail;
            return $item;
        });  
    }
    
    public function getPoster($id)  // Per salvare i posters al database
    {
        return $this->getPosters($id)->first();   // first permette di ricevere il primo elemento dell'array
    }
    
}