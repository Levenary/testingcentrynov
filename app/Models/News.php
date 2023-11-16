<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    // News.php
public function comments()
{
    return $this->hasMany(Comment::class);
}

// Comment.php
public function user()
{
    return $this->belongsTo(User::class);
}
}