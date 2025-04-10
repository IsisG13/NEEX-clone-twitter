<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'usuarios_id',
    ];
    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
    public function comments()
    {
        return $this->hasMany(Comentarios::class, 'tweet_id');
    }
}