<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Removed the duplicate namespace and use statements

class UserFoodInteraction extends Model
{
    protected $table = 'user_food_interactions';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['user_id', 'food_id', 'is_liked', 'is_saved'];

    protected $casts = [
        'is_liked' => 'boolean',
        'is_saved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
