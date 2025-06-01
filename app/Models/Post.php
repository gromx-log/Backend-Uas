<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'postId'; // Karena kamu pakai postId, bukan id
    public $timestamps = false; // Karena kamu hanya pakai created_at manual

    protected $fillable = [
        'userId',
        'content',
        'parent_post_id',
    ];
}
