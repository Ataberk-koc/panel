<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', 'tr');
        return [
            'id' => $this->id,
            'title' => $this->getTranslation('title', $locale),
            'short_description' => $this->getTranslation('short_description', $locale),
            'description' => $this->getTranslation('description', $locale),
            'desktop_image' => $this->desktop_image ? url('storage/' . $this->desktop_image) : null,
            'mobile_image' => $this->mobile_image ? url('storage/' . $this->mobile_image) : null,
            'url' => $this->getTranslation('url', $locale),
            'button_text' => $this->getTranslation('button_text', $locale),
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'slider_type' => $this->slider_type,
            'is_active' => $this->is_active,
            'is_enabled' => $this->is_enabled,
            'show_on_desktop' => $this->show_on_desktop,
            'show_on_mobile' => $this->show_on_mobile,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
