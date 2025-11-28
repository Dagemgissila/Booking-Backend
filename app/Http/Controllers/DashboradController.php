<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboradController extends Controller
{
    public function stats()
    {
        $totalUsers = \App\Models\User::count();
        $totalRooms = \App\Models\Room::count();
        $totalReservations = \App\Models\Reservation::count();
        $totalRevenue = \App\Models\Reservation::sum('total_price');

        return response()->json([
            'success' => true,
            'data' => [
                'totalUsers' => $totalUsers,
                'totalRooms' => $totalRooms,
                'totalReservations' => $totalReservations,
                'totalRevenue' => $totalRevenue,
            ],
        ]);
    }
}
