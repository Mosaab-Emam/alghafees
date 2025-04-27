<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'name',
        'description',
        'image',
        'rating',
        'body',
    ];

    public function getIsFilledAttribute()
    {
        return $this->name != null &&
            $this->description != null &&
            $this->image != null &&
            $this->rating != null &&
            $this->body != null;
    }
}
