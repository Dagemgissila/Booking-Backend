<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'reservation_code' => $this->reservation_code,
            'status'          => $this->status,
            'total_price'     => $this->total_price,
            'start_time'      => $this->start_time,
            'end_time'        => $this->end_time,
            'note'            => $this->note,

            'room' => new RoomResource($this->whenLoaded('room')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
