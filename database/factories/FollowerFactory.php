<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'following_id' => $this->faker->unique()->numberBetween(1, 10),
            // 'followed_id' => $this->faker->numberBetween(1, 10),
            'following_id' => User::all()->random()->id,
            'followed_id' => User::all()->random()->id,
        ];
    }
}
