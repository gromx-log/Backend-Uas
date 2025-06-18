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
        return $this->hasMany(Post::class, 'parent_post_id', 'postId')->orderBy('created_at', 'desc');
    }

    // Post ini memiliki banyak likes
    public function likes()
    {
        return $this->hasMany(likes::class, 'post_id', 'postId');
    }
    // Post ini di like oleh user tertentu
    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    // Hitung jumlah likes
    public function likesCount()
    {
        return $this->likes()->count();
    }

    // Post ini di bookmark oleh user tertentu
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'postId', 'userId')->withTimestamps();
    }


    // Hitung jumlah komentar
    public function commentsCount()
    {
        return $this->replies()->count();
    }
}
