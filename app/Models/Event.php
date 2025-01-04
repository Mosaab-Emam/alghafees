<?php

namespace App\Models;

use FilamentTiptapEditor\Concerns\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'date',
        'description',
        'location',
        'images'
    ];

    protected $casts = [
        'date' => 'date',
        'images' => 'json'
    ];
}
