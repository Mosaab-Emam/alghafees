<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackYourRequestStaticContent extends Model
{
    use HasFactory;

    protected $fillable = [
        "small_top_title",
        "main_top_title",
        "title",
        "description",
        "search_placeholder",
        "btn_text"
    ];
}
