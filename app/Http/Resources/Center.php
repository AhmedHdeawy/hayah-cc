<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Center extends JsonResource
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
            'address' => $this->address,
            'coupon' => $this->coupon,
            'discount_value' => $this->discount_value,
            'hours' => $this->hours,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'phone' => $this->phone,
            'notes' => $this->notes,
            'logo_url' => $this->logo_url,
            'branches' => Branch::collection($this->branches),
        ];
    }
}
