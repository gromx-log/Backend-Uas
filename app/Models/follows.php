<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    protected $table = 'follows';
    protected $fillable = ['follower_id', 'following_id'];
    
    // Tidak ada timestamps otomatis, hanya created_at
    public $timestamps = false;
    
    protected $dates = ['created_at'];

    // Relationship ke User yang mengikuti
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id', 'userId');
    }

    // Relationship ke User yang diikuti
    public function following()
    {
        return $this->belongsTo(User::class, 'following_id', 'userId');
    }
}