<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
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
