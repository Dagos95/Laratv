<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'surname',
        'nickname',
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function followed()
    {
        //return $this->belongsToMany('App\User');  //Crea la relazione delle tabelle molti a molti
        return $this->belongsToMany(User::class, 'user_user', 'user_id_1', 'user_id_2');    //entrambi sono corretti   //'user_user' è il nome della tabella  //bisogna scrivere nel terzo e quarto paramentro gli id delle due colonne 'user_id_1' e 'user_id_2' 
    }
    
    public function followers()
    {
       
        return $this->belongsToMany(User::class, 'user_user', 'user_id_2', 'user_id_1');    //ho invertito gli id perchè in questo modo ho la possibilità di far associare in entrambi le parti le tabelle
    }
    
    public function series()
    {
        return $this->belongsToMany(Serie::class);
    }
}
