<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[    // Filtra le cose da far vedere e cose no con le chiamate API
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'nickname' => $this->nickname,
            'series' => SerieResource::collection($this->series)  // Permette di far funzionare il filtro dell'altro documento
        ];
    }
}
