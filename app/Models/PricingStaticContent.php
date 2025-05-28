<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingStaticContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'small_top_title',
        'main_top_title',
        'hero_title',
        'hero_image',
        'hero_description',
        'hero_goals_title',
        'hero_goals',
        'payment_title',
        'payment_description',
        'contact_description',
        'packages_title',
        'packages_description',
        'banner_title',
        'banner_subtitle',
        'banner_description',
        'banner_button_text',
    ];

    protected $casts = [
        'hero_goals' => 'array',
    ];
}
