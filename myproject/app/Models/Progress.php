<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Progress extends Model
{
    protected $table = 'progresses';
    protected $fillable = [
        'user_id',
        'title',
        'is_active'
    ];

    public function logs()
    {
        return $this->hasMany(DailyLog::class);
    }
}