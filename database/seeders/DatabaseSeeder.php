<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1 Admin
        User::factory()->admin()->create([
            'first_name' => 'Admin',
            'last_name'  => 'User',
            'email'      => 'admin@example.com',
            'password'   => bcrypt('password'),
        ]);

        // 10 Users
        User::factory()->count(10)->create();

        // 10 Rooms
        Room::factory()->count(10)->create();

        // 10 Reservations
        Reservation::factory()->count(10)->create();
    }
}
