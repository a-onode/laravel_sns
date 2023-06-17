<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'serve_id',
        'tweet_id',
        'type',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [
        'user_id',
        'serve_id',
        'tweet_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serveUser()
    {
        return $this->belongsTo(User::class, 'serve_id');
    }

    public function tweets()
    {
        return $this->belongsTo(Tweet::class, 'tweet_id');
    }
}
