<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            'email'      => $this->faker->unique()->safeEmail(),
            'password'   => Hash::make('password'),
            'role'       => 'user',
            'email_verified_at' => now(),
        ];
    }

    // Admin state
    public function admin()
    {
        return $this->state(fn() => ['role' => 'admin']);
    }
}
