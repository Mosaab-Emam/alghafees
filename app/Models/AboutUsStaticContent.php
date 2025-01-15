<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsStaticContent extends Model
{
    use HasFactory;

    protected $fillable = [
        "small_top_title",
        "main_title",
        "about_top_title",
        "about_first_title",
        "about_first_description",
        "about_second_title",
        "about_second_description",
        "management_title",
        "management_description",
        // Placeholder for qualifications
        "feat1_title",
        "feat1_description",
        "feat2_title",
        "feat2_description",
        "feat3_title",
        "feat3_description",
        "values_title",
        // Placeholder for values
        "vision_title",
        "vision_description",
        "message_title",
        "message_description",
        "reports_title"
    ];
}
