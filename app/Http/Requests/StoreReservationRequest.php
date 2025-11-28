<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Reservation;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'room_id'     => 'required|exists:rooms,id',
            'start_time'  => 'required|date|after_or_equal:now',
            'end_time'    => 'required|date|after:start_time',
            'total_price' => 'required|numeric|min:0',
            'note'        => 'nullable|string',

            // Only admin can send user_id
            'user_id'     => 'nullable|exists:users,id',
        ];
    }

    public function prepareForValidation()
    {
        // If normal user → force their own ID
        // if (auth()->user()->role === 'user') {
        $this->merge(['user_id' => auth()->id()]);
        // }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $start = $this->start_time;
            $end   = $this->end_time;

            $exists = Reservation::where('room_id', $this->room_id)
                ->where(function ($query) use ($start, $end) {
                    $query->whereBetween('start_time', [$start, $end])
                        ->orWhereBetween('end_time', [$start, $end])
                        ->orWhere(function ($q) use ($start, $end) {
                            $q->where('start_time', '<=', $start)
                                ->where('end_time', '>=', $end);
                        });
                })
                ->exists();

            if ($exists) {
                $validator->errors()->add('room_id', 'This room is already booked for the selected time range.');
            }
        });
    }
}
