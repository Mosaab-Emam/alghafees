<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->when($request->route()->parameter('slug'), $this->content),
            'featured_image' => $this->image(),
            'published_at' => $this->published_at?->format('Y-m-d'),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}

