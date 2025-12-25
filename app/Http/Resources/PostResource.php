<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', 'tr');
        return [
            'id' => $this->id,
            'title' => $this->getTranslation('title', $locale),
            'slug' => $this->getTranslation('slug', $locale),
            'content' => $this->getTranslation('content', $locale),
            'summary' => $this->getTranslation('summary', $locale),
            'image' => $this->image ? url('storage/' . $this->image) : null,
            'banner' => $this->banner ? url('storage/' . $this->banner) : null,
            'is_active' => $this->is_active,
            'published_at' => $this->published_at,
            'categories' => $this->whenLoaded('categories', function () use ($request) {
                return CategoryResource::collection($this->categories);
            }),
            'tags' => $this->whenLoaded('tags', function () use ($request) {
                return TagResource::collection($this->tags);
            }),
        ];
    }
}
