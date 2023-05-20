<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tweet_id',
    ];

    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }

    public function isFavorite(Int $tweetId)
    {
        return (bool) self::where('user_id', Auth::id())->where('tweet_id', $tweetId)->exists();
    }
}
