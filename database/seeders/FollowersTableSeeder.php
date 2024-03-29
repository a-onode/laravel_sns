<?php

namespace Database\Seeders;

use App\Models\Follower;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Follower::factory(10)->create();
    }
}
