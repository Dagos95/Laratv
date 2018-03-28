<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Api\TheTvApi;

class Serie extends Model
{
    protected $fillable = [
      'thetv_id',
      'title',
      'poster_url',
    ];
    
    public function fetchData()
    {
        if(!$this->thetv_id)
        {
            throw new \Exception("Attributo 'thetv_id' non valorizzato");
        }
        
        $api = new TheTvApi;    
        $info_serie = $api->getSerie($this->thetv_id);
        $poster = $api->getPoster($this->thetv_id);
        
        $this->fill([
            'title' => $info_serie->seriesName,
            'poster_url' => !empty($poster->fileName) ? $poster->fileName : '',
        ]);
    }
    
    public function getData()
    {
        $api = new TheTvApi;
        return $api->getSerie($this->thetv_id);
    }
}
