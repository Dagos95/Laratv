<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = [
      'thetv_id',
      'title',
      'poster_url',
    ];
}
