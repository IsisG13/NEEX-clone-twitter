<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguir extends Model
{
    use HasFactory;

    protected $fillable = [
        'seguidor_id',
        'seguindo_id',
        ];
}
