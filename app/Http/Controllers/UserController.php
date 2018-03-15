<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Api\TheTvApi;

use App\Serie;

class UserController extends Controller
{
    public function follow($id)    // Metodo per poter mandare l'amicizia nella tabella
    {
        //Istanza dell'utentre loggato
        
        $user = auth()->user();
        
        // Controllare se quell'utente esiste
        
        if($id != $user->id && $user->followed()->where('user_id_2', $id)->count() == 0){  //Impedisce di far ricercare l'utente loggato tramite il search
            
             //Aggiungo la relazione
        
            $user->followed()->attach($id);
        };
        
       
        
        //Torno alla pagina precedente
        
        return redirect()->back();
    }
    
    public function unfollow($id)   // Metodo per poter togliere l'amicizia nella tabella
    {
        $user = auth()->user();
        
        $user->followed()->detach($id);
        
        return redirect()->back();
    }
    
    public function profilo()   // Metodo che permette di far funzionare la pagina profilo
    {
        $user = auth()->user();
        
        return view('user.profile', compact('user'));
    }
    
    public function edit()   // Metodo che permette di far funzionare la pagina modifica profilo
    {
        $user = auth()->user();
        
        return view('form-edit.edit', compact('user'));  // La view della pagina lo prende dalla cartella form-edit nella view
    }
    
    public function editUpdate(Request $request)  
    {
        $this->validate($request, [
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'nickname' => 'required|string|max:255|unique:users,nickname,'.auth()->id(),  //users è il nome della tabella
        'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
        'password' => 'nullable|string|min:6|confirmed',
        ]);
        
        // Recupero l'istanza dell'utente loggato
        
        $user = auth()->user();
        
        // Scrivo nell'istanza i dati aggiornati senza la password
        
        $user->fill( $request->except('password') );
        
        // Se l'utente modifica la password la aggiorno
        
        if( $request->has('password') ){   // Quando bisogna usare il metodo if/else, bisogna usare sempre has quando un utente deve passare un istanza   // has controlla se il valore è true o false   // Se da un errore di accesso al login/modifica profilo, al posto di has bisogna inserire filled
            $user->password = bcrypt($request->input('password'));
            
        }
        
        // Salvo i dati nel database
        
        $user->save();
        
        return redirect()
               ->back()
               ->with('message-success', 'Profilo aggiornato'); 
    }
    
    public function followSerie($thetv_id)
    {
        $user = auth()->user();
        
        // 1. Cercare serie con id esterno $thetv_id   
        // Se il punto uno è andato a buon fine va direttamente al punto 3, altrimenti entra dentro if (quindi passa al punto 2)
        $serie = Serie::where('thetv_id', $thetv_id)->first();
        
        // 2. Se non esiste salvare i dati sul db
        if( empty($serie)){
            
            // L avariabile api prende il percorso da use (in cima al documento)
            $api = new TheTvApi;
            
            // 2.1. Recupero i dati sulla serie dalla API
            $info_serie = $api->getSerie($thetv_id);
            
            // 2.2. Recupero i poster della serie dalle API
            $poster = $api->getPoster($thetv_id); // getPoster si trova dentro app > api > TheTvApi.php
            
            // 2.3. Salvo nel database
            //$serie = new Serie;
             //$serie->thetv_id = $thetv_id;
            //$serie->title = $info_serie->seriesName;
            //$serie->poster_url = $poster->fileName;
            //$serie->save();
            
            
            // Create permette di instanziare, riempire e salvare 
            $serie = Serie::create([      // Questo metodo o quello di sopra è uguale, però se si vuole scegliere questo metodo bisogna andare su app > Serie.php e creare una variabile protected
                'thetv_id' => $thetv_id,
                'title' => $info_serie->seriesName,
                'poster_url' => !empty($poster->fileName) ? $poster->fileName : '',
            ]);    
            
        } 
        
        // 3. Associazione serie a utente
        $user->series()->attach($serie->id);
        
        return redirect()->back();
    }
    
    public function unfollowSerie($thetv_id)
    {
        // 1. Recupero l'utente loggato
        $user = auth()->user();
        
        // 2. Recuper la serie dal database
        $serie = Serie::where('thetv_id', $thetv_id)->first();
        
        // 3. Se trovo la serie tolgo l'associazione con l'utente
        if($serie){
            $user->series()->detach($serie->id);
        }
        
        // 4. Torno indietro
        return redirect()->back();
    }
}
