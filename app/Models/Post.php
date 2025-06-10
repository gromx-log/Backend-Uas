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
        'created_at' => 'datetime', // <-- TAMBAHKAN BARIS INI
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

    // Post ini memiliki banyak balasan
    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_post_id', 'postId')->orderBy('created_at', 'asc');
    }

    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'postId', 'userId')->withTimestamps();
    }

}
