<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // 1. İstenen dili al (Header'dan, yoksa varsayılan 'tr')
        $locale = $request->header('Accept-Language', 'tr');

        return [
            'id' => $this->id,
            // 2. Sadece istenen dili döndür
            'title' => $this->getTranslation('title', $locale),
            'slug' => $this->getTranslation('slug', $locale),
            'description' => $this->getTranslation('description', $locale),
            'content' => $this->getTranslation('content', $locale),
            'meta_title' => $this->getTranslation('meta_title', $locale),
            'meta_description' => $this->getTranslation('meta_description', $locale),
            'meta_keywords' => $this->getTranslation('meta_keywords', $locale),
            'logo' => $this->logo ? url('storage/' . $this->logo) : null,
            'banner' => $this->banner ? url('storage/' . $this->banner) : null,
            'gallery_images' => $this->gallery_images,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'parent_id' => $this->parent_id,
            'parent' => $this->whenLoaded('parent', function () use ($request) {
                return new CategoryResource($this->parent);
            }),
            'children' => $this->whenLoaded('children', function () use ($request) {
                return CategoryResource::collection($this->children);
            }),
            'posts' => $this->whenLoaded('posts', function () use ($request) {
                // PostResource varsa onu kullan, yoksa dizi döndür
                return $this->posts;
            }),
        ];
    }
}