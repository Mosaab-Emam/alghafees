<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PricingStaticContentResource extends JsonResource
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
            'small_top_title' => $this->small_top_title,
            'main_top_title' => $this->main_top_title,
            'hero_title' => $this->hero_title,
            'hero_image' => $this->hero_image,
            'hero_description' => $this->hero_description,
            'hero_goals_title' => $this->hero_goals_title,
            'hero_goals' => $this->hero_goals,
            'payment_title' => $this->payment_title,
            'payment_description' => $this->payment_description,
            'contact_description' => $this->contact_description,
            'packages_title' => $this->packages_title,
            'packages_description' => $this->packages_description,
            'banner_title' => $this->banner_title,
            'banner_subtitle' => $this->banner_subtitle,
            'banner_description' => $this->banner_description,
            'banner_button_text' => $this->banner_button_text,
        ];
    }
}

