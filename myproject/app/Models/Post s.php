<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'post_id';

    protected $fillable = [
        'user_id',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ TAMBAH NI
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function comments()
{
    return $this->hasMany(Comment::class, 'post_id');
}

public function saves()
{
    return $this->hasMany(Save::class, 'post_id');
}
}
