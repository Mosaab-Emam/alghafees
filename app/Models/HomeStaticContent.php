<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeStaticContent extends Model
{
    use HasFactory;

    protected $fillable = [
        // Hero Section
        'hero_small_top_title',
        'hero_main_title',
        'hero_description',
        'hero_main_button_text',
        'hero_main_button_link',
        'hero_secondary_button_text',
        'hero_secondary_button_link',
        'hero_download_box_text',
        'hero_x_link',
        'hero_linkedin_link',
        'hero_youtube_link',
        'hero_vertical_text',

        // About Section
        'about_small_top_title',
        'about_big_top_title',
        'about_main_title',
        'about_description',
        'about_feat1_title',
        'about_feat1_description',
        'about_feat2_title',
        'about_feat2_description',
        'about_feat3_title',
        'about_feat3_description',
        'about_button_text',
        'about_button_link',

        // Our Services
        'services_small_top_title',
        'services_main_title',
        'services_description',
        'services_button_text',
        'services_button_link',
        'services_stat1_number',
        'services_stat1_text',
        'services_stat2_number',
        'services_stat2_text',
        'services_stat3_number',
        'services_stat3_text',
        'services_events_small_top_title',
        'services_events_main_title',
        'services_events_video_url',
        'services_events_button_text',
        'services_events_button_link',

        // Our Clients
        'clients_small_top_title',
        'clients_main_title',
        'clients_description',
        'clients_button_text',
        'clients_button_link',

        // Contact Us
        'contact_us_small_top_title',
        'contact_us_main_title',
        'contact_us_form_title',
        'contact_us_form_description',
    ];
}
