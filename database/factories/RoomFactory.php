<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = \App\Models\Room::class;

    public function definition()
    {
        return [
            'room_number'    => $this->faker->unique()->numberBetween(100, 500),
            'floor'          => $this->faker->numberBetween(1, 5),
            'beds'           => $this->faker->numberBetween(1, 4),
            'price_per_hour' => $this->faker->randomFloat(2, 20, 100),
            'image'          => "rooms/sample" . rand(1, 10) . ".jpg",
            'status'         => 1, // active
        ];
    }
}
