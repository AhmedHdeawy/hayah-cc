<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Branch extends JsonResource
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
            'distance' => $this->distance,
            'name' => $this->name,
            'address' => $this->address,
            'discount_value' => $this->discount_value,
            'hours' => $this->hours,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'phone' => $this->phone,
            'notes' => $this->notes,
            'logo_url' => $this->logo_url,
            'city_id' => $this->city ? $this->city->id : null,
            'city_name' => $this->city ? $this->city->name : null,
            'category_id' => $this->category ? $this->category->id : null,
            'category_name' => $this->category ? $this->category->name : null,
            'governorate_id' => $this->governorate ? $this->governorate->id : null,
            'governorate_name' => $this->governorate ? $this->governorate->name : null,
            'center' => new Center($this->center),
        ];
    }
}
