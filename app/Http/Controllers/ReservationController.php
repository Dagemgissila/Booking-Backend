<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request)
    {
        $userId = $request->user_id;

        $reservation = Reservation::create([
            'user_id'          => $userId,
            'room_id'          => $request->room_id,
            'start_time'       => $request->start_time,
            'end_time'         => $request->end_time,
            'reservation_code' => 'RSV-' . strtoupper(uniqid()),
            'total_price'      => $request->total_price,
            'note'             => $request->note,
            'status'           => 'active',
        ]);

        return new ReservationResource($reservation->load('room', 'user'));
    }


    public function myReservations()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->with(['room'])
            ->orderBy("created_at", "desc")
            ->get();

        return ReservationResource::collection($reservations);
    }

    public function adminIndex()
    {

        $reservations = Reservation::with(['user', 'room'])->get();
        return ReservationResource::collection($reservations);
    }


    public function checkAvailability(Request $request, Room $room)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time',
        ]);

        $start = $request->start_time;
        $end   = $request->end_time;

        $exists = Reservation::where('room_id', $room->id)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_time', [$start, $end])
                    ->orWhereBetween('end_time', [$start, $end])
                    ->orWhere(function ($q) use ($start, $end) {
                        $q->where('start_time', '<=', $start)
                            ->where('end_time', '>=', $end);
                    });
            })
            ->exists();

        return response()->json([
            "available" => !$exists,
            "message"   => $exists
                ? "Room is already booked for these times."
                : "Room is available."
        ]);
    }
}
