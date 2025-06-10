<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class Post extends Model
{
    protected $primaryKey = 'postId'; 
    public $timestamps = false; 

    protected $fillable = [
        'userId', 
        'content',
        'parent_post_id',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
    ];
    
    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }

    // Post ini adalah balasan terhadap post lain
    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_post_id', 'postId');
    }

    // Post ini memiliki banyak balasan (comments)
    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_post_id', 'postId')->orderBy('created_at', 'asc');
    }
    
    public function likes()
    {
        return $this->hasMany(likes::class, 'post_id', 'postId'); // Note: using 'likes' model name as in your code
    }

    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    // Add these new methods for counts
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function getCommentsCountAttribute()
    {
        return $this->replies()->count();
    }

    // Alternative method names if you prefer
    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function commentsCount()
    {
        return $this->replies()->count();
    }
}