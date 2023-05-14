<?php

namespace Database\Factories;

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
            'following_id' => $this->faker->numberBetween(1, 50),
            'followed_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
