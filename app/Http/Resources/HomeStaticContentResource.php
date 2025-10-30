<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeStaticContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // Hero Section
            'hero_small_top_title' => $this->hero_small_top_title,
            'hero_main_title' => $this->hero_main_title,
            'hero_description' => $this->hero_description,
            'hero_main_button_text' => $this->hero_main_button_text,
            'hero_main_button_link' => $this->hero_main_button_link,
            'hero_secondary_button_text' => $this->hero_secondary_button_text,
            'hero_secondary_button_link' => $this->hero_secondary_button_link,
            'hero_download_box_text' => $this->hero_download_box_text,
            'hero_vertical_text' => $this->hero_vertical_text,

            // About Section
            'about_small_top_title' => $this->about_small_top_title,
            'about_big_top_title' => $this->about_big_top_title,
            'about_main_title' => $this->about_main_title,
            'about_description' => $this->about_description,
            'about_feat1_title' => $this->about_feat1_title,
            'about_feat1_description' => $this->about_feat1_description,
            'about_feat2_title' => $this->about_feat2_title,
            'about_feat2_description' => $this->about_feat2_description,
            'about_feat3_title' => $this->about_feat3_title,
            'about_feat3_description' => $this->about_feat3_description,
            'about_button_text' => $this->about_button_text,
            'about_button_link' => $this->about_button_link,

            // Services Section
            'services_small_top_title' => $this->services_small_top_title,
            'services_main_title' => $this->services_main_title,
            'services_description' => $this->services_description,
            'services_button_text' => $this->services_button_text,
            'services_button_link' => $this->services_button_link,
            'services_stat1_number' => $this->services_stat1_number,
            'services_stat1_text' => $this->services_stat1_text,
            'services_stat2_number' => $this->services_stat2_number,
            'services_stat2_text' => $this->services_stat2_text,
            'services_stat3_number' => $this->services_stat3_number,
            'services_stat3_text' => $this->services_stat3_text,
            'services_events_small_top_title' => $this->services_events_small_top_title,
            'services_events_main_title' => $this->services_events_main_title,
            'services_events_video_url' => $this->services_events_video_url,
            'services_events_button_text' => $this->services_events_button_text,
            'services_events_button_link' => $this->services_events_button_link,

            // Clients Section
            'clients_small_top_title' => $this->clients_small_top_title,
            'clients_main_title' => $this->clients_main_title,
            'clients_description' => $this->clients_description,
            'clients_button_text' => $this->clients_button_text,
            'clients_button_link' => $this->clients_button_link,

            // Contact Us Section
            'contact_us_small_top_title' => $this->contact_us_small_top_title,
            'contact_us_main_title' => $this->contact_us_main_title,
            'contact_us_form_title' => $this->contact_us_form_title,
            'contact_us_form_description' => $this->contact_us_form_description,
        ];
    }
}

