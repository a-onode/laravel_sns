<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'tweet_id',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }
}
