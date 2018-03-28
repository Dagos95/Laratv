<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function show(Serie $instance)
    {
        // 1. Recuperare dettagli da TheTvDb
        // 
       $data = $instance->getData();
        return view('show/show', compact('instance', 'data'));
    }

}
