<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function following()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'follower_id',
            'followed_id'
        );
    }
    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'followed_id',
            'follower_id'
        );
    }
}
