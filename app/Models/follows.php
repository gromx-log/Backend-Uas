<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['follower_id', 'following_id'];

    // Relationship ke User yang mengikuti
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    // Relationship ke User yang diikuti
    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}