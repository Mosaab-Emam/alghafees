<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeStaticContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_small_top_title',
        'hero_main_title',
        'hero_image',
        'description',
        'hero_main_button_text',
        'hero_main_button_link',
        'hero_secondary_button_text',
        'hero_secondary_button_link',
        'hero_download_box_text',
        'hero_x_link',
        'hero_linkedin_link',
        'hero_youtube_link',
        'hero_vertical_text',
    ];
}
