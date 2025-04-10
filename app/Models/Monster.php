<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'behavior',
        'habitat'
    ];
}
