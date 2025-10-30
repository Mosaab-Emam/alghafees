<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoStaticContentResource extends JsonResource
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
            'description' => $this->description,
            'info_section_title' => $this->info_section_title,
            'work_hours' => $this->work_hours,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'whatsapp_number' => $this->whatsapp_number,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'ios_app_link' => $this->ios_app_link,
            'android_app_link' => $this->android_app_link,
            'x_link' => $this->x_link,
            'linkedin_link' => $this->linkedin_link,
            'youtube_link' => $this->youtube_link,
        ];
    }
}

