<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
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
        return $this->hasMany(Comentarios::class, 'usuario_id');
    }
    public function following()
    {
        return $this->belongsToMany(
            User::class,
            'seguidores',
            'seguidor_id',
            'seguindo_id'
        );
    }
    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'seguidores',
            'seguidor_id',
            'seguindo_id'
        );
    }
}