<?php

namespace App\Services;

use App\Models\Favorite;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public static function getFavoriteTweets($id)
    {
        $favorites = Favorite::where('user_id', Auth::id())->pluck('tweet_id')->toArray();
        $favoriteTweets = Tweet::whereIn('id', $favorites)->latest()->get();

        return $favoriteTweets;
    }
}
