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
}
