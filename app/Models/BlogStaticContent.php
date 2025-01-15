<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogStaticContent extends Model
{
    use HasFactory;

    protected $fillable = [
        "small_top_title",
        "main_top_title",
        "title",
        "description",
        "blog_small_title",
        "blog_main_title"
    ];
}
