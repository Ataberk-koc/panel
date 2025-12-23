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
            'key' => $this->key,
            'value' => $this->getTranslation('value', $locale),
            'description' => $this->getTranslation('description', $locale),
            'created_at' => $this->created_at,
        ];
    }
}
