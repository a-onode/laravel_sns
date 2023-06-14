<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Follower;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Notification;

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
            NotificationTableSeeder::class,
        ]);
        User::factory(10)->create();
        Tweet::factory(10)->create();
        Follower::factory(10)->create();
        Comment::factory(10)->create();
        Favorite::factory(10)->create();
        Notification::factory(10)->create();
    }
}
