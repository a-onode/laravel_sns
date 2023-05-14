<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Follower;
use App\Models\Comment;
use App\Models\Favorite;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            TweetsTableSeeder::class,
            FollowersTableSeeder::class,
            CommentsTableSeeder::class,
            FavoritesTableSeeder::class,
        ]);
        User::factory(50)->create();
        Tweet::factory(100)->create();
        Follower::factory(25)->create();
        Comment::factory(150)->create();
        Favorite::factory(25)->create();
    }
}
