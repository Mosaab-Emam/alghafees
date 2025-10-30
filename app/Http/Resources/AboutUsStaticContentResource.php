<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsStaticContentResource extends JsonResource
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
            'about_top_title' => $this->about_top_title,
            'about_first_title' => $this->about_first_title,
            'about_first_description' => $this->about_first_description,
            'about_second_title' => $this->about_second_title,
            'about_second_description' => $this->about_second_description,
            'management_title' => $this->management_title,
            'management_description' => $this->management_description,
            'feat1_title' => $this->feat1_title,
            'feat1_description' => $this->feat1_description,
            'feat2_title' => $this->feat2_title,
            'feat2_description' => $this->feat2_description,
            'feat3_title' => $this->feat3_title,
            'feat3_description' => $this->feat3_description,
            'values_title' => $this->values_title,
            'vision_title' => $this->vision_title,
            'vision_description' => $this->vision_description,
            'message_title' => $this->message_title,
            'message_description' => $this->message_description,
            'reports_title' => $this->reports_title,
        ];
    }
}

