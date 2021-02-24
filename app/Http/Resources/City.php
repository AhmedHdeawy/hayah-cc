<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class City extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'governorate_id' => $this->governorate ? $this->governorate->id : null,
            'governorate_name' => $this->governorate ? $this->governorate->name : null,
        ];
    }
}
