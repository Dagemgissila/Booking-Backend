<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Room;

class ReservationFactory extends Factory
{
    protected $model = \App\Models\Reservation::class;

    public function definition()
    {
        $start = $this->faker->dateTimeBetween('+1 days', '+30 days');
        $end   = (clone $start)->modify('+' . rand(1, 4) . ' hours');

        return [
            'user_id'          => User::inRandomOrder()->first()->id,
            'room_id'          => Room::inRandomOrder()->first()->id,
            'start_time'       => $start,
            'end_time'         => $end,
            'reservation_code' => 'RSV-' . strtoupper($this->faker->unique()->bothify('???###')),
            'total_price'      => rand(50, 500),
            'note'             => $this->faker->sentence(),
            'status'           => 'active',
        ];
    }
}
