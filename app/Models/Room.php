<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_title',
        'image',
        'description',
        'price',
        'room_count',
        'wifi',
        'room_type'
    ];
}
