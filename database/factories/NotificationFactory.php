<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'server_id' => User::all()->random()->id,
            'tweet_id' => Tweet::all()->random()->id,
            'type' => $this->faker->randomElement([1, 2, 3]),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
