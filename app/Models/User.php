<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'userId';
    protected $keyType = 'int'; 
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'userHandle',
        'email',
        'password',
        'bio',
        'followCount',
        'followedCount',
        'joined_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'userId', 'userId');
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    // Following (yang diikuti oleh user ini)
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    // Helper methods
    public function isFollowing($userId)
    {
        return $this->following()->where('following_id', $userId)->exists();
    }

    public function follow($userId)
    {
        if (!$this->isFollowing($userId) && $this->userId != $userId) {
            return $this->following()->attach($userId);
        }
    }

    public function unfollow($userId)
    {
        return $this->following()->detach($userId);
    }

    public function followersCount()
    {
        return $this->followers()->count();
    }

    public function followingCount()
    {
        return $this->following()->count();
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'userId', 'postId')
                    ->withPivot('created_at'); 
    }

    public function likes()
    {
        return $this->hasMany(likes::class, 'user_id', 'userId'); 
    }

    // Add this missing relationship for liked posts
    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }

    public function getRouteKeyName()
    {
        return 'userId';
    }

    //added for search feature
    public function getAuthIdentifierName()
    {
        return 'userId'; // Use userId as the identifier
    }

}

