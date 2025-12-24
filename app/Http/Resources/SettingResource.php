<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', 'tr');
        return [
            'id' => $this->id,
            'site_name' => $this->site_name,
            'slogan' => $this->slogan ?? null,
            'footer_icon' => $this->footer_icon,
            'email' => $this->email,
            'social_media' => $this->social_media,
            'full_address' => $this->full_address ?? null,
            'postal_code' => $this->postal_code,
            'working_hours' => $this->working_hours,
            'google_embeded_url' => $this->google_embeded_url,
            'site_white_logo' => $this->site_white_logo,
            'site_dark_logo' => $this->site_dark_logo,
            'favicon' => $this->favicon,
            'address' => $this->address,
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'created_at' => $this->created_at,
        ];
    }
}
