<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    //Likes model
    protected $fillable = ['user_id', 'post_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userId');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'postId');
    }
}
