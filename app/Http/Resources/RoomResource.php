<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'room_number'   => $this->room_number,
            'image' => asset('storage/' . $this->image),
            'floor'         => $this->floor,
            'beds'          => $this->beds,
            'price_per_hour' => $this->price_per_hour,
            'status'        => $this->status,
        ];
    }
}
