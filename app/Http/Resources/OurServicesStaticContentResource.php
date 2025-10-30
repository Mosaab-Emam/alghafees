<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OurServicesStaticContentResource extends JsonResource
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
            'main_title' => $this->main_title,
            'main_description' => $this->main_description,
            'services_title' => $this->services_title,
        ];
    }
}

